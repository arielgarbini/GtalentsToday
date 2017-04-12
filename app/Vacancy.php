<?php

namespace Vanguard;

use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vanguard\Support\Enum\GeneralStatus;
use Vanguard\Events\Vacancy\UpdatedSupplier;
use Vanguard\Events\Vacancy\UpdatedCandidate;

class Vacancy extends Model
{
    use SoftDeletes;

    protected $table = 'vacancies';

    public $primaryKey = 'id';

    public $timestamps = true;

    public $dates = ['deleted_at'];

    protected $fillable = [	'poster_user_id', 
    						'name', 
    						//'description', 
    						'positions_number', 
    						//'scheme_work_id', 
    						'responsabilities', 
    						//'experience', 
    						//'file',  
    					//	'key_points', 
    					//	'minimum_salary',
    					//	'maximum_salary',
    					//	'career_plan',
    						'contract_type_id',
    					//	'sharing',
    					//	'address_id',
    						'vacancy_status_id',

                            'location', 
                            'target_companies',
                            'off_limits_companies', 
                            'responsabilities', 
                            'required_experience',  
                            'range_salary',
                            'key_position_questions', 
                            'file_job_description',
                            'file_employer',
                            'industry',
                            'search_type',
                            'years_experience',
                            'especialization_id',
                            'warranty_employer',
                            'replacement_period_id',
                            'general_conditions',
                            'group1',
                            'group2',
                            'fee',
                            'terms',
                            'company_id'
                        ];                   


    public function asSupplier()
    {
        return $this->hasMany(VacancyUser::class);
    }


    public function poster()
    {
        return $this->belongsTo(User::class, 'poster_user_id');
    }

   public function contract()
    {
        return $this->hasOne(Contract::class, 'vacancy_id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'vacancy_id');
    }

    public function condition()
    {
        return $this->hasOne(Condition::class, 'vacancy_id');
    }

    public function scheme_work()
    {
        return $this->hasOne(SchemeWork::class, 'id', 'scheme_work_id');
    }

    public function vacancy_status()
    {
        return $this->hasOne(VacancyStatus::class, 'id', 'vacancy_status_id');
    }
    
    public function contract_type()
    {
        return $this->hasOne(ContractType::class, 'id', 'contract_type_id');
    }

   /* public function address()
    {
        return $this->hasOne(Address::class, 'id', 'address_id');
    }

    public function vacancy_logs()
    {
        return $this->hasMany(VacancyLog::class, 'vacancy_id');
    }
*/
    public function languages(){
        return $this->belongsToMany(Language::class,'vacancy_languages');
    }

    public function supplier(){
        return $this->belongsToMany(User::class,'vacancy_users', 'vacancy_id', 'supplier_user_id')
                    ->withPivot('status','is_active','comment', 'created_at', 'updated_at');
    }

    public function candidates(){
        return $this->belongsToMany(Candidate::class,'vacancy_candidates', 'vacancy_id', 'candidate_id')
                    ->withPivot('status', 'created_at', 'updated_at', 'deleted_at');
    }
    
    public function countViews()
    {
        return DB::table('user_activity')->where('description', 'like', '%v:'.$this->id.':%')
                                         ->where('user_id', '!=', $this->poster_user_id)
                                         ->count();
    }

    public function postulate()
    {
        $result = VacancyUser::where('vacancy_id', '=', $this->id)
                                ->where('supplier_user_id', '=', Auth::user()->id)
                                ->first();
        if(!$result)
            return false;

        return $result;
    }

    public function countApplicationByStatus($status)
    {
        $result = VacancyUser::where('vacancy_id', '=', $this->id)
                                ->where('status', '=', $status)
                                ->count();
        return $result;
    }


    public function pendingSuppliers()
    {
        $result = VacancyUser::where('vacancy_id', '=', $this->id)
                                ->where('status', '=', GeneralStatus::UNCONFIRMED)
                                ->get();
        return $result;
    }

    public function activeSuppliers()
    {
        $result = VacancyUser::where('vacancy_id', '=', $this->id)
            ->where('status', '=', 1)
            ->get();
        return $result;
    }

    public function countCandidatesByStatus($status)
    {
        $result = VacancyCandidate::where('vacancy_id', $this->id)
                                ->where('status', $status)
                                ->count();
        return $result;
    }

    public function updateStatusSupplier($supplier_id, $status)
    {
        $data = [ 'status'     => $status,
                  'updated_at' => \Carbon\Carbon::now() ];

        $result = VacancyUser::where('vacancy_id', '=', $this->id)
                            ->where('supplier_user_id', '=', $supplier_id)
                            ->update($data);

        event(new UpdatedSupplier ($this->id, $supplier_id, $status));
                            
        return $this->countApplicationByStatus($status); 
    }

    public function pendingCandidates()
    {
        $result = VacancyCandidate::where('vacancy_id', '=', $this->id)
                                ->where('status', '=', GeneralStatus::UNCONFIRMED)
                                ->get();
        return $result;

    }

    public function updateStatusCandidate($candidate_id, $status)
    {
        $data = [ 'status'     => $status,
                  'updated_at' => \Carbon\Carbon::now() ];

        $result = VacancyCandidate::where('vacancy_id', '=', $this->id)
                            ->where('candidate_id', '=', $candidate_id)
                            ->update($data);

        event(new UpdatedCandidate ($this->id, $candidate_id, $status));

        return $this->countCandidatesByStatus($status);
    }

    public function isApprobateSupplier()
    {
        $result = VacancyUser::where('vacancy_id', '=', $this->id)
                                ->where('supplier_user_id', '=', Auth::user()->id)
                                ->where('status', '=', GeneralStatus::ACTIVE)
                                ->count();
        return $result;
    }

    public function isApprobateCandidate($candidate)
    {
        $result = VacancyCandidate::where('vacancy_id', '=', $this->id)
                                ->where('candidate_id', '=', $candidate)
                                ->where('status', '=', GeneralStatus::ACTIVE)
                                ->count();
        if($result > 0)
            return true;
        else
            return false;
    }

    public function createContract()
    {
        //Copy contract of poster, pending
        $copy = 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.';

        $company_id = '';

        if(!Auth::user()->hasRole('Admin'))
            $company_id = Auth::user()->company_user->company_id;

        $data = ['vacancy_id' => $this->id,
                'company_id'  => $company_id,
                'nda'         => substr (microtime(), 11, 20),
                'contract'    => $copy,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
                ];

        $contract = Contract::create($data);

        return $contract;
    }

    public function viewed()
    {
        return $this->hasMany(VacancyViewed::class);
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
}

