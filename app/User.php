<?php

namespace Vanguard;

use Vanguard\Presenters\UserPresenter;
use Vanguard\Services\Auth\TwoFactor\Authenticatable as TwoFactorAuthenticatable;
use Vanguard\Services\Auth\TwoFactor\Contracts\Authenticatable as TwoFactorAuthenticatableContract;
use Vanguard\Services\Logging\UserActivity\Activity;
use Vanguard\Support\Authorization\AuthorizationUserTrait;
use Vanguard\Support\Enum\UserStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laracasts\Presenter\PresentableTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract,
                                    TwoFactorAuthenticatableContract
{
    use TwoFactorAuthenticatable, CanResetPassword, PresentableTrait, AuthorizationUserTrait;

    protected $presenter = UserPresenter::class;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $dates = ['last_login', 'birthday'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'first_name', 'last_name', 'phone',
        'secundary_phone', 'avatar', 'prefix', 'address_id', 'country_id', 'birthday',
        'last_login', 'confirmation_token', 'code', 'status', 'is_active', 'group_id',
        'time_connect', 'category_id', 'years_recruitment_id', 'education_level_id',
        'assisted_schools', 'memberships', 'code_linkedin', 'id_linkedin'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Always encrypt password when it is updated.
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = trim($value) ?: null;
    }

    public function gravatar()
    {
        $hash = hash('md5', strtolower(trim($this->attributes['email'])));

        return sprintf("//www.gravatar.com/avatar/%s", $hash);
    }

    public function isUnconfirmed()
    {
        return $this->status == UserStatus::UNCONFIRMED;
    }

    public function isUnverified()
    {
        return $this->status == UserStatus::UNVERIFIED;
    }

    public function isActive()
    {
        return $this->status == UserStatus::ACTIVE;
    }

    public function isBanned()
    {
        return $this->status == UserStatus::BANNED;
    }

    public function socialNetworks()
    {
        return $this->hasOne(UserSocialNetworks::class, 'user_id');
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'id', 'address_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'user_id');
    }

    public function scores()
    {
        return $this->hasMany(Score::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class, 'supplier_user_id');
    }

    public function company_user()
    {
        return $this->hasOne(CompanyUser::class, 'user_id');
    }

    public function company(){
        return $this->belongsToMany(Company::class,'companies_users', 'user_id', 'company_id')->withPivot('is_active', 'position', 'created_at', 'updated_at');
    }

    public function vacancy(){
        return $this->belongsToMany(Vacancy::class,'vacancy_users', 'supplier_user_id', 'vacancy_id')->withPivot('status', 'is_active', 'comment', 'created_at', 'updated_at');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function points()
    {
        return $this->hasOne(Point::class, 'user_id');
    }

    public function legal_information()
    {
        return $this->hasOne(LegalInformation::class, 'id', 'user_id');
    }

    public function preferences()
    {
        return $this->hasOne(Preference::class, 'id', 'user_id');
    }

    public function education_level()
    {
        return $this->hasOne(EducationLevel::class, 'id', 'education_level_id');
    }

    public function years_recruitment()
    {
        return $this->hasOne(ExperienceYear::class, 'id', 'years_recruitment_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class)->orderBy('created_at', 'desc');
    }

    public function vacancy_users()
    {
        return $this->hasMany(VacancyUser::class, 'supplier_user_id');
    }

    public function candidates_offer($vacancy_id)
    {
        $applied = Candidate::where('supplier_user_id', $this->id)->whereHas('vacancy', function($query) use($vacancy_id){
            $query->where('vacancy_id', $vacancy_id);
        })->count();
        return $applied;
    }

    public function candidates_applied()
    {
        $applied = Candidate::where('supplier_user_id', $this->id)->whereHas('vacancy', function($query){
            $query->where('status', '!=', null);
        })->count();
        return $applied;
    }

    public function candidates_accepted()
    {
        $applied = $this->candidates_applied();
        if($applied == 0){
            return 0;
        }
        $accepted = Candidate::where('supplier_user_id', $this->id)->whereHas('vacancy', function($query){
            $query->where('status', 'Active');
        })->count();
        return ($accepted * 100) / $applied;
    }
}
