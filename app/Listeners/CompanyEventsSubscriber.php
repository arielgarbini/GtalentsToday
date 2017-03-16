<?php

namespace Vanguard\Listeners;

use Vanguard\Activity;
use Vanguard\Events\Company\Created;
use Vanguard\Events\Company\Deleted;
use Vanguard\Events\Company\Updated;
use Vanguard\Events\Company\UpdatedCompanyProfile;
use Vanguard\Events\Company\UpdatedCompanyExperience;
use Vanguard\Services\Logging\UserActivity\Logger;

class CompanyEventsSubscriber
{
    /**
     * @var UserActivityLogger
     */
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function onCreate(Created $event)
    {
        $company = $event->getCompany();

        $name = $company->comercial_name .' '. $company->register_number;
        $message = trans('log.new_company', ['name' => $name]);

        $this->logger->log($message);
    }

    public function onUpdate(Updated $event)
    {
        $company = $event->getCompany();

        $name = $company->comercial_name .' '. $company->register_number;
        $message = trans('log.updated_company', ['name' => $name]);

        $this->logger->log($message);
    }

    public function onUpdateExperience(UpdatedCompanyExperience $event)
    {
        $message = trans('log.updated_company_experience');

        $this->logger->log($message);
    }

    public function onUpdateProfile(UpdatedCompanyProfile $event)
    {
        $message = trans('log.updated_company_profile');

        $this->logger->log($message);
    }

    public function onDelete(Deleted $event)
    {
        $company = $event->getCompany();

        $name = $company->comercial_name .' '. $company->register_number;
        $message = trans('log.deleted_company', ['name' => $name]);

        $this->logger->log($message);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $class = 'Vanguard\Listeners\CompanyEventsSubscriber';

        $events->listen(Created::class, "{$class}@onCreate");
        $events->listen(Updated::class, "{$class}@onUpdate");
        $events->listen(UpdatedCompanyExperience::class, "{$class}@onUpdateExperience");
        $events->listen(UpdatedCompanyProfile::class, "{$class}@onUpdateProfile");
        $events->listen(Deleted::class, "{$class}@onDelete");
    }
}
