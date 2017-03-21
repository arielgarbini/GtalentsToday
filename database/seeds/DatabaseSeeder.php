<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(CountriesSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(LanguagesSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(EducationLevelsSeeder::class);
        $this->call(ExperienceYearsSeeder::class);
        $this->call(AddressTypesSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(QuantityEmployeesSeeder::class);
        $this->call(CompaniesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ActualPositionsSeeder::class);
        $this->call(CasesNumbersSeeder::class);
        $this->call(FunctionalAreasSeeder::class);
        $this->call(LevelPositionsSeeder::class);
        $this->call(SourcingNetworksSeeder::class);
        $this->call(RegionsSeeder::class);
        $this->call(SectorsSeeder::class);
        $this->call(IndustriesSeeder::class);
        $this->call(ExperienceRolesSeeder::class);
        $this->call(ProfilePositionsSeeder::class);
        $this->call(TypeInvolvedOpportunitiesSeeder::class);
        $this->call(TypeInvolvedSearchsSeeder::class);
        $this->call(TypeSharedOpportunitiesSeeder::class);
        $this->call(TypeSharedSearchsSeeder::class);
        $this->call(SchemeWorksSeeder::class);
        $this->call(VacancyStatusSeeder::class);
        $this->call(ContractTypesSeeder::class);
        $this->call(CandidatesSeeder::class);
        //$this->call(VacanciesSeeder::class);
        //$this->call(ConditionsSeeder::class);
        //$this->call(VacancyUsersSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(SecurityQuestionsSeeder::class);
        $this->call(ContactsSeeder::class);
        $this->call(OrganizationRolesSeeder::class);
        $this->call(CompensationsSeeder::class);
        $this->call(ReplacementPeriodSeeder::class);
        Model::reguard();
    }
}
