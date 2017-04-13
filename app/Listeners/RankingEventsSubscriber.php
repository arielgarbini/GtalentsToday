<?php

namespace Vanguard\Listeners;

use Vanguard\Point;
use Vanguard\Company;
use Vanguard\CompanyUser;
use Vanguard\Category;
use Vanguard\Events\NotificationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class RankingEventsSubscriber implements ShouldQueue
{
    public function handle($event)
    {
        $dataRequest = $event->getData();
        $company = $this->getUserCompany($dataRequest['user_id']);
        Point::create(['user_id' => $dataRequest['user_id'], 'sum' =>$dataRequest['points'], 'company_id' => $company->id]);
        if($dataRequest['points']>0) {
            $this->sendNotification($company, $dataRequest['points'], 'get_points');
            if ($company->category_id < 8 && $company->points->sum('sum') >= Category::find($company->category_id + 1)->required_points) {
                $category = Category::find($company->category_id + 1);
                $this->updateRanking($company, $company->category_id + 1);
                $this->sendNotification($company, $category->name, 'promotion_received');
            }
        } else {
            if ($company->category_id > 1 && $company->points->sum('sum') >= Category::find($company->category_id - 1)->required_points) {
                $category = Category::find($company->category_id - 1);
                $this->updateRanking($company, $company->category_id - 1);
            }
        }
    }

    public function getUserCompany($user_id)
    {
        return Company::whereHas('company_users', function($query) use($user_id){
            $query->where('user_id', $user_id);
        })->get()->first();
    }

    public function getListUsersCompany($company_id)
    {
        $data = [];
        $company = CompanyUser::where('company_id', $company_id)->get();
        foreach($company as $com){
            $data[] = $com->user_id;
        }
        return $data;
    }

    public function updateRanking($company, $new_ranking)
    {
        $company->category_id = $new_ranking;
        $company->save();
    }

    public function sendNotification($company, $points, $type)
    {
        foreach($this->getListUsersCompany($company->id) as $user){
            event(new NotificationEvent(['element_id' => $company->id,
                'user_id'=>$user, 'type' => $type, 'name'=>$points]));
        }
    }
}