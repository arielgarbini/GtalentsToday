<?php

namespace Vanguard\Providers;

use Carbon\Carbon;
use Vanguard\Repositories\Activity\ActivityRepository;
use Vanguard\Repositories\Activity\EloquentActivity;
use Vanguard\Repositories\Country\CountryRepository;
use Vanguard\Repositories\Country\EloquentCountry;
use Vanguard\Repositories\Permission\EloquentPermission;
use Vanguard\Repositories\Permission\PermissionRepository;
use Vanguard\Repositories\Role\EloquentRole;
use Vanguard\Repositories\Role\RoleRepository;
use Vanguard\Repositories\Company\EloquentCompany;
use Vanguard\Repositories\Company\CompanyRepository;
use Vanguard\Repositories\Session\DbSession;
use Vanguard\Repositories\Session\SessionRepository;
use Vanguard\Repositories\User\EloquentUser;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Repositories\Profile\EloquentProfile;
use Vanguard\Repositories\Profile\ProfileRepository;
use Vanguard\Repositories\Experience\EloquentExperience;
use Vanguard\Repositories\Experience\ExperienceRepository;
use Vanguard\Repositories\ProfilePosition\EloquentProfilePosition;
use Vanguard\Repositories\ProfilePosition\ProfilePositionRepository;
use Vanguard\Repositories\Candidate\EloquentCandidate;
use Vanguard\Repositories\Candidate\CandidateRepository;
use Vanguard\Repositories\Vacancy\EloquentVacancy;
use Vanguard\Repositories\Vacancy\VacancyRepository;
use Vanguard\Repositories\Vacancy\EloquentVacancyLog;
use Vanguard\Repositories\Vacancy\VacancyLogRepository;
use Vanguard\Repositories\ActualPosition\EloquentActualPosition;
use Vanguard\Repositories\ActualPosition\ActualPositionRepository;
use Vanguard\Repositories\TypeSharedSearch\EloquentTypeSharedSearch;
use Vanguard\Repositories\TypeSharedSearch\TypeSharedSearchRepository;
use Vanguard\Repositories\TypeInvolvedSearch\EloquentTypeInvolvedSearch;
use Vanguard\Repositories\TypeInvolvedSearch\TypeInvolvedSearchRepository;
use Vanguard\Repositories\TypeSharedOpportunity\EloquentTypeSharedOpportunity;
use Vanguard\Repositories\TypeSharedOpportunity\TypeSharedOpportunityRepository;
use Vanguard\Repositories\TypeInvolvedOpportunity\EloquentTypeInvolvedOpportunity;
use Vanguard\Repositories\TypeInvolvedOpportunity\TypeInvolvedOpportunityRepository;
use Vanguard\Repositories\CasesNumber\EloquentCasesNumber;
use Vanguard\Repositories\CasesNumber\CasesNumberRepository;
use Vanguard\Repositories\Category\EloquentCategory;
use Vanguard\Repositories\Category\CategoryRepository;
use Vanguard\Repositories\Condition\ConditionRepository;
use Vanguard\Repositories\Condition\EloquentCondition;
use Vanguard\Repositories\ExperienceYear\EloquentExperienceYear;
use Vanguard\Repositories\ExperienceYear\ExperienceYearRepository;
use Vanguard\Repositories\FunctionalArea\EloquentFunctionalArea;
use Vanguard\Repositories\FunctionalArea\FunctionalAreaRepository;
use Vanguard\Repositories\LevelPosition\EloquentLevelPosition;
use Vanguard\Repositories\LevelPosition\LevelPositionRepository;
use Vanguard\Repositories\Region\EloquentRegion;
use Vanguard\Repositories\Region\RegionRepository;
use Vanguard\Repositories\Sector\EloquentSector;
use Vanguard\Repositories\Sector\SectorRepository;
use Vanguard\Repositories\Industry\IndustryRepository;
use Vanguard\Repositories\Industry\EloquentIndustry;
use Vanguard\Repositories\Invoice\InvoiceRepository;
use Vanguard\Repositories\Invoice\EloquentInvoice;
use Vanguard\Repositories\ExperienceRole\ExperienceRoleRepository;
use Vanguard\Repositories\ExperienceRole\EloquentExperienceRole;
use Vanguard\Repositories\SourcingNetwork\SourcingNetworkRepository;
use Vanguard\Repositories\SourcingNetwork\EloquentSourcingNetwork;
use Vanguard\Repositories\Message\EloquentMessage;
use Vanguard\Repositories\Message\MessageRepository;
use Vanguard\Repositories\News\EloquentNews;
use Vanguard\Repositories\News\NewsRepository;
use Vanguard\Repositories\SchemeWork\EloquentSchemeWork;
use Vanguard\Repositories\SchemeWork\SchemeWorkRepository;
use Vanguard\Repositories\ContractType\EloquentContractType;
use Vanguard\Repositories\ContractType\ContractTypeRepository;
use Vanguard\Repositories\VacancyStatus\EloquentVacancyStatus;
use Vanguard\Repositories\VacancyStatus\VacancyStatusRepository;
use Vanguard\Repositories\Language\EloquentLanguage;
use Vanguard\Repositories\Language\LanguageRepository;
use Vanguard\Repositories\AddressType\EloquentAddressType;
use Vanguard\Repositories\AddressType\AddressTypeRepository;
use Vanguard\Repositories\Address\EloquentAddress;
use Vanguard\Repositories\Address\AddressRepository;
use Vanguard\Repositories\Point\EloquentPoint;
use Vanguard\Repositories\Point\PointRepository;
use Vanguard\Repositories\QuantityEmployees\EloquentQuantityEmployees;
use Vanguard\Repositories\QuantityEmployees\QuantityEmployeesRepository;
use Vanguard\Repositories\Contact\EloquentContact;
use Vanguard\Repositories\Contact\ContactRepository;
use Vanguard\Repositories\OrganizationRole\EloquentOrganizationRole;
use Vanguard\Repositories\OrganizationRole\OrganizationRoleRepository;
use Vanguard\Repositories\SecurityQuestion\EloquentSecurityQuestion;
use Vanguard\Repositories\SecurityQuestion\SecurityQuestionRepository;
use Vanguard\Repositories\EducationLevel\EloquentEducationLevel;
use Vanguard\Repositories\EducationLevel\EducationLevelRepository;
use Vanguard\Repositories\VacancyUser\EloquentVacancyUser;
use Vanguard\Repositories\VacancyUser\VacancyUserRepository;
use Vanguard\Repositories\CompanyUser\EloquentCompanyUser;
use Vanguard\Repositories\CompanyUser\CompanyUserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(config('app.locale'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepository::class, EloquentUser::class);
        $this->app->singleton(ActivityRepository::class, EloquentActivity::class);
        $this->app->singleton(RoleRepository::class, EloquentRole::class);
        $this->app->singleton(PermissionRepository::class, EloquentPermission::class);
        $this->app->singleton(SessionRepository::class, DbSession::class);
        $this->app->singleton(CountryRepository::class, EloquentCountry::class);
        $this->app->singleton(CompanyRepository::class, EloquentCompany::class);
        $this->app->singleton(ProfileRepository::class, EloquentProfile::class);
        $this->app->singleton(CandidateRepository::class, EloquentCandidate::class);
        $this->app->singleton(ExperienceRepository::class, EloquentExperience::class);
        $this->app->singleton(ProfilePositionRepository::class, EloquentProfilePosition::class);
        $this->app->singleton(ActualPositionRepository::class, EloquentActualPosition::class);
        $this->app->singleton(TypeSharedSearchRepository::class, EloquentTypeSharedSearch::class);
        $this->app->singleton(TypeInvolvedSearchRepository::class, EloquentTypeInvolvedSearch::class);
        $this->app->singleton(TypeSharedOpportunityRepository::class, EloquentTypeSharedOpportunity::class);
        $this->app->singleton(TypeInvolvedOpportunityRepository::class, EloquentTypeInvolvedOpportunity::class);
        $this->app->singleton(CasesNumberRepository::class, EloquentCasesNumber::class);
        $this->app->singleton(CategoryRepository::class, EloquentCategory::class);
        $this->app->singleton(ExperienceYearRepository::class, EloquentExperienceYear::class);
        $this->app->singleton(FunctionalAreaRepository::class, EloquentFunctionalArea::class);
        $this->app->singleton(LevelPositionRepository::class, EloquentLevelPosition::class);
        $this->app->singleton(RegionRepository::class, EloquentRegion::class);
        $this->app->singleton(SectorRepository::class, EloquentSector::class);
        $this->app->singleton(IndustryRepository::class, EloquentIndustry::class);
        $this->app->singleton(InvoiceRepository::class, EloquentInvoice::class);
        $this->app->singleton(ExperienceRoleRepository::class, EloquentExperienceRole::class); 
        $this->app->singleton(SourcingNetworkRepository::class, EloquentSourcingNetwork::class);
        $this->app->singleton(MessageRepository::class, EloquentMessage::class);
        $this->app->singleton(NewsRepository::class, EloquentNews::class);
        $this->app->singleton(VacancyRepository::class, EloquentVacancy::class);
        $this->app->singleton(SchemeWorkRepository::class, EloquentSchemeWork::class);
        $this->app->singleton(ContractTypeRepository::class, EloquentContractType::class);
        $this->app->singleton(VacancyStatusRepository::class, EloquentVacancyStatus::class);
        $this->app->singleton(LanguageRepository::class, EloquentLanguage::class);
        $this->app->singleton(AddressRepository::class, EloquentAddress::class);
        $this->app->singleton(AddressTypeRepository::class, EloquentAddressType::class);
        $this->app->singleton(VacancyLogRepository::class, EloquentVacancyLog::class);
        $this->app->singleton(ConditionRepository::class, EloquentCondition::class);
        $this->app->singleton(PointRepository::class, EloquentPoint::class);
        $this->app->singleton(QuantityEmployeesRepository::class, EloquentQuantityEmployees::class);
        $this->app->singleton(ContactRepository::class, EloquentContact::class);
        $this->app->singleton(OrganizationRoleRepository::class, EloquentOrganizationRole::class);
        $this->app->singleton(SecurityQuestionRepository::class, EloquentSecurityQuestion::class);
        $this->app->singleton(EducationLevelRepository::class, EloquentEducationLevel::class);
        $this->app->singleton(VacancyUserRepository::class, EloquentVacancyUser::class);
        $this->app->singleton(CompanyUserRepository::class, EloquentCompanyUser::class);

        if ($this->app->environment('local')) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
