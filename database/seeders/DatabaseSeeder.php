<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\College;
use App\Models\Program;
use App\Models\ActionPlan;
use App\Models\Comment;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\FeedbackSource;
use App\Models\Notification;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // -------------
        // USER
        // -------------
        // User::factory(200)->create();
        User::factory()
            ->create([
                'id' => 1000,
                'firstname' => 'Gisan Geff',
                'lastname' => 'Raniego',
                'username' => 'gisangeff',
                'phone_number' => '09123789178',
                'email_address' => 'gisangeff@gmail.com',
                'position' => 'Vice President',
                'role' => 'Super Admin',
                'password' => bcrypt('Gisangeff321'),
                'status' => 'Active',
            ]);

        User::factory()
            ->create([
                'id' => 2000,
                'firstname' => 'Gisan Dan',
                'lastname' => 'Raniego',
                'username' => 'gisangdan',
                'phone_number' => '09750492685',
                'email_address' => 'gisandanraniego@gmail.com',
                'position' => 'Developer',
                'role' => 'Admin',
                'password' => bcrypt('gisandan'),
                'status' => 'Active',
            ]);

        User::factory()
            ->create([
                'id' => 3000,
                'firstname' => 'Gisan Mae',
                'lastname' => 'Raniego',
                'username' => 'gisanmae',
                'phone_number' => '09123789179',
                'email_address' => 'gisanmaeraniego@gmail.com',
                'position' => 'Dean',
                'role' => 'Regular',
                'password' => bcrypt('gisanmae'),
                'status' => 'Active',
            ]);



        // -------------
        // CONVERSATION
        // -------------
        // Conversation::factory(250)->create();

        // -------------
        // MESSAGE
        // -------------
        // Message::factory(250)->create();

        // -------------
        // NOTIFICATION
        // -------------
        // Notification::factory(250)->create();

        // -------------
        // COMMENT
        // -------------
        // Comment::factory(250)->create();

        // -------------
        // COLLEGE
        // -------------
        College::factory()
            ->create([
                'name' => 'PS',
                'description' => 'Professional Schools',
            ]);
        College::factory()
            ->create([
                'name' => 'CLE',
                'description' => 'College of Legal Education',
            ]);
        College::factory()
            ->create([
                'name' => 'CAE',
                'description' => 'College of Accounting Education',
            ]);
        College::factory()
            ->create([
                'name' => 'CAFAE',
                'description' => 'College of Architecture and Fine Arts Education',
            ]);
        College::factory()
            ->create([
                'name' => 'CASE',
                'description' => 'College of Arts and Sciences Education',
            ]);
        College::factory()
            ->create([
                'name' => 'CBAE',
                'description' => 'College of Business Administration Education',
            ]);
        College::factory()
            ->create([
                'name' => 'CCE',
                'description' => 'College of Computing Education',
            ]);
        College::factory()
            ->create([
                'name' => 'CCJE',
                'description' => 'College of Criminal Justice Education',
            ]);
        College::factory()
            ->create([
                'name' => 'CEE',
                'description' => 'College of Engineering Education',
            ]);
        College::factory()
            ->create([
                'name' => 'CHE',
                'description' => 'College of Hospitality Education',
            ]);
        College::factory()
            ->create([
                'name' => 'CHSE',
                'description' => 'College of Health Sciences Education',
            ]);
        College::factory()
            ->create([
                'name' => 'CTE',
                'description' => 'College of Teacher Education',
            ]);
        College::factory()
            ->create([
                'name' => 'TS',
                'description' => 'Technical School',
            ]);
        College::factory()
            ->create([
                'name' => 'BE',
                'description' => 'Basic Education',
            ]);




        // -------------
        // PROGRAM
        // -------------
        Program::factory()
            ->create([
                'college_id' => '7',
                'name' => 'BSIT',
                'description' => 'Bachelor of Science in Information Technology',
            ]);
        Program::factory()
            ->create([
                'college_id' => '7',
                'name' => 'BSCS',
                'description' => 'Bachelor of Science in Computer Science',
            ]);
        Program::factory()
            ->create([
                'college_id' => '7',
                'name' => 'BSIS',
                'description' => 'Bachelor of Science in Information Systems',
            ]);
        Program::factory()
            ->create([
                'college_id' => '7',
                'name' => 'BLIS',
                'description' => 'Bachelor of Library and Information Science',
            ]);
        Program::factory()
            ->create([
                'college_id' => '7',
                'name' => 'BSEMC - Digital Animation',
                'description' => 'Bachelor of Science in Entertainment and Multimedia Computing – Digital Animation',
            ]);
        Program::factory()
            ->create([
                'college_id' => '7',
                'name' => 'BSEMC - Game Development',
                'description' => 'Bachelor of Science in Entertainment and Multimedia Computing – Game Development',
            ]);
        Program::factory()
            ->create([
                'college_id' => '2',
                'name' => 'BSA(Accountancy)',
                'description' => 'Bachelor of Science in Accountancy',
            ]);
        Program::factory()
            ->create([
                'college_id' => '2',
                'name' => 'BSIA', 'description' =>
                'Bachelor of Science in Internal Auditing',
            ]);
        Program::factory()
            ->create([
                'college_id' => '2',
                'name' => 'BSAIS', 'description' =>
                'Bachelor of Science in Accounting Information System',
            ]);
        Program::factory()
            ->create([
                'college_id' => '3',
                'name' => 'BSMA',
                'description' => ' Bachelor of Science in Management Accounting',
            ]);
        Program::factory()
            ->create([
                'college_id' => '3',
                'name' => 'BSA(Architecture)',
                'description' => 'Bachelor of Science in Architecture',
            ]);
        Program::factory()
            ->create([
                'college_id' => '4',
                'name' => 'BFAD',
                'description' => 'Bachelor of Fine Arts and Design',
            ]);
        Program::factory()
            ->create([
                'college_id' => '4',
                'name' => 'BAC',
                'description' => 'Bachelor of Arts in Communications',
            ]);
        Program::factory()
            ->create([
                'college_id' => '4',
                'name' => 'BAMA',
                'description' => 'Bachelor of Arts in Multimedia Arts',
            ]);
        Program::factory()
            ->create([
                'college_id' => '4',
                'name' => 'BSF',
                'description' => 'Bachelor of Science in Forestry',
            ]);
        Program::factory()
            ->create([
                'college_id' => '4',
                'name' => 'BSA',
                'description' => 'Bachelor of Science in Agroforestry',
            ]);
        Program::factory()
            ->create([
                'college_id' => '5',
                'name' => 'BSES',
                'description' => 'Bachelor of Science in Environmental Science',
            ]);
        Program::factory()
            ->create([
                'college_id' => '6',
                'name' => 'PS',
                'description' => 'Preschool',
            ]);
        Program::factory()
            ->create([
                'college_id' => '6',
                'name' => 'ELEM',
                'description' => 'Elementary ',
            ]);
        Program::factory()
            ->create([
                'college_id' => '6',
                'name' => 'JHS',
                'description' => 'Junior High School ',
            ]);
        Program::factory()
            ->create([
                'college_id' => '8',
                'name' => 'BSE',
                'description' => 'Bachelor of Science in Entrepreneurship',
            ]);
        Program::factory()
            ->create([
                'college_id' => '8',
                'name' => 'BSL',
                'description' => 'Bachelor of Science in Legal Management',
            ]);
        Program::factory()
            ->create([
                'college_id' => '9',
                'name' => 'BSRM',
                'description' => 'Bachelor of Science in Real Estate Management',
            ]);
        Program::factory()
            ->create([
                'college_id' => '9',
                'name' => 'BSBABE',
                'description' => 'Bachelor of Science in Business Administration – Business Economics',
            ]);
        Program::factory()
            ->create([
                'college_id' => '9',
                'name' => 'BSBAFM',
                'description' => 'Bachelor of Science in Business Administration – Financial Management',
            ]);
        Program::factory()
            ->create([
                'college_id' => '9',
                'name' => 'BSCE(Chemical Engineering)',
                'description' => 'Bachelor of Science in Chemical Engineering',
            ]);
        Program::factory()
            ->create([
                'college_id' => '9',
                'name' => 'BSME',
                'description' => 'Bachelor of Science in Mechanical Engineering',
            ]);
        Program::factory()
            ->create([
                'college_id' => '9',
                'name' => 'BSEE(Electrical Engineering)',
                'description' => 'Bachelor of Science in Electrical Engineering',
            ]);
        Program::factory()
            ->create([
                'college_id' => '10',
                'name' => 'BSCE(Computer Engineering)',
                'description' => 'Bachelor of Science in Computer Engineering',
            ]);
        Program::factory()
            ->create([
                'college_id' => '10',
                'name' => 'BSC',
                'description' => 'Bachelor of Science in Criminology',
            ]);
        Program::factory()
            ->create([
                'college_id' => '10',
                'name' => 'BSISM',
                'description' => 'Bachelor of Science in Industrial Security Management',
            ]);
        Program::factory()
            ->create([
                'college_id' => '10',
                'name' => 'BSN',
                'description' => 'Bachelor of Science in Nursing',
            ]);
        Program::factory()
            ->create([
                'college_id' => '10',
                'name' => 'BSP',
                'description' => 'Bachelor of Science in Pharmacy',
            ]);
        Program::factory()
            ->create([
                'college_id' => '11',
                'name' => 'BSMT',
                'description' => 'Bachelor of Science in Medical Technology/Medical Laboratory Science',
            ]);
        Program::factory()
            ->create([
                'college_id' => '11',
                'name' => 'BSND',
                'description' => 'Bachelor of Science in Nutrition and Dietetics',
            ]);
        Program::factory()
            ->create([
                'college_id' => '13',
                'name' => 'BSHM',
                'description' => 'Bachelor of Science in Hospitality Management',
            ]);
        Program::factory()
            ->create([
                'college_id' => '13',
                'name' => 'BSTM',
                'description' => 'Bachelor of Science in Tourism Management',
            ]);
        Program::factory()
            ->create([
                'college_id' => '13',
                'name' => 'MSA',
                'description' => 'Master of Science in Accountancy',
            ]);
        Program::factory()
            ->create([
                'college_id' => '13',
                'name' => 'MBA',
                'description' => ' Master in Business Administration',
            ]);
        Program::factory()
            ->create([
                'college_id' => '13',
                'name' => 'MPA',
                'description' => ' Master in Public Administration',
            ]);
        Program::factory()
            ->create([
                'college_id' => '13',
                'name' => 'MIT',
                'description' => ' Master of Information Technology',
            ]);
        Program::factory()
            ->create([
                'college_id' => '13',
                'name' => 'MAC',
                'description' => ' Master of Arts in Communication',
            ]);
        Program::factory()
            ->create([
                'college_id' => '13',
                'name' => 'MSAE',
                'description' => ' Master of Science in Agricultural Economics',
            ]);
        Program::factory()
            ->create([
                'college_id' => '14',
                'name' => 'BEE',
                'description' => 'Bachelor of Elementary Education',
            ]);
        Program::factory()
            ->create([
                'college_id' => '14',
                'name' => 'BECE',
                'description' => 'Bachelor of Early Childhood Education',
            ]);
        Program::factory()
            ->create([
                'college_id' => '14',
                'name' => 'BSNEMEST',
                'description' => 'Bachelor of Special Needs Education Major in Elementary School Teaching',
            ]);
        Program::factory()
            ->create([
                'college_id' => '14',
                'name' => 'BSNEMECE',
                'description' => 'Bachelor of Special Needs Education Major in Early Childhood Education',
            ]);
        Program::factory()
            ->create([
                'college_id' => '14',
                'name' => 'BPE',
                'description' => 'Bachelor in Physical Education',
            ]);
        Program::factory()
            ->create([
                'college_id' => '13',
                'name' => 'AS',
                'description' => 'Automotive Servicing',
            ]);
        Program::factory()
            ->create([
                'college_id' => '13',
                'name' => 'EPAS',
                'description' => 'Electronic Product Assembly and Servicing',
            ]);
        Program::factory()
            ->create([
                'college_id' => '13',
                'name' => 'EIM',
                'description' => 'Electrical Installation Maintenance',
            ]);
        Program::factory()
            ->create([
                'college_id' => '13',
                'name' => 'CG',
                'description' => 'Caregiving',
            ]);




        // -------------
        // FEEDBACK SOURCES
        // -------------
        // FeedbackSource::factory(200)->create();
        FeedbackSource::factory()
            ->create([
                'name' => 'Industry/PAC'
            ]);
        FeedbackSource::factory()
            ->create([
                'name' => 'Course Assessment'
            ]);
        FeedbackSource::factory()
            ->create([
                'name' => 'Suggestion Box'
            ]);

        // -------------
        // ACTION PLAN
        // -------------
        // ActionPlan::factory(44124)->create(
        //     ['status' => 'Complied']
        // );

        // ActionPlan::factory(12124)->create(
        //     ['status' => 'On-going']
        // );

        // ActionPlan::factory(22032)->create(
        //     ['status' => 'Delayed']
        // );

        // ActionPlan::factory(34034)->create(
        //     ['status' => 'Pending']
        // );

        ActionPlan::factory()->create([
            'user_id' => '1',
            'feedback_source_id' => '1',
            'feedback' => 'Students do not know how to compute taxes.',
            'actions_to_be_taken' => 'Offer taxation courses prior to OJT deployment',
            'expected_compliance_period' => '2021-11-01 22:06:41',
            'status' => 'Complied',
            'expected_outcome' => 'Enhanced curriculum',
            'means_of_verification' => 'Prospectus',
            'person_in_charge_id' => 1,
            'action_to' => 'College',
            'action_to_id' => '1',
        ]);

        ActionPlan::factory()->create([
            'user_id' => '1',
            'feedback_source_id' => '2',
            'feedback' => 'Teachers got low rating (below threshold) in syllabus related items',
            'actions_to_be_taken' => 'Implement departmental examination in all professional courses to ensure syllabus is fully covered.',
            'expected_compliance_period' => '2021-12-01 22:06:41',
            'status' => 'Complied',
            'expected_outcome' => 'Improved performance of teachers in course assessment in syllabus related items',
            'means_of_verification' => 'Subsequent course assessment results',
            'person_in_charge_id' => 1,
            'action_to' => 'College',
            'action_to_id' => '2',
        ]);

        ActionPlan::factory()->create([
            'user_id' => '1',
            'feedback_source_id' => '1',
            'feedback' => 'Students do not know how to use e-BIR forms',
            'actions_to_be_taken' => 'Use various e-BIR forms in tax simulation filing in competency assessment for tax courses.',
            'expected_compliance_period' => '2021-11-01 22:06:41',
            'status' => 'Complied',
            'expected_outcome' => 'Improved performance in OJT',
            'means_of_verification' => 'Individual practicum Evaluation',
            'person_in_charge_id' => 1,
            'action_to' => 'Program',
            'action_to_id' => '1',
        ]);

        ActionPlan::factory()->create([
            'user_id' => '1',
            'feedback_source_id' => '3',
            'feedback' => 'STAs do not entertain us politely (suplada).',
            'actions_to_be_taken' => 'Re-orient STAs on how to build good relationship with students.',
            'expected_compliance_period' => '2021-11-21 22:06:41',
            'status' => 'Delayed',
            'expected_outcome' => 'No recurring incidents',
            'means_of_verification' => 'Minutes of meeting',
            'person_in_charge_id' => 1,
            'action_to' => 'Program',
            'action_to_id' => '2',
        ]);

        ActionPlan::factory()->create([
            'user_id' => '1',
            'feedback_source_id' => '1',
            'feedback' => 'Graduates are poor in applying theory into practice.',
            'actions_to_be_taken' => 'Design practice sets to address student’s deficiency in applying theory to practice.',
            'expected_compliance_period' => '2021-11-01 22:06:41',
            'status' => 'On-Going',
            'expected_outcome' => 'Improved performance in competency assessment',
            'means_of_verification' => 'Practice Set, Competency assessment results',
            'person_in_charge_id' => 1,
            'action_to' => 'College',
            'action_to_id' => '3',
        ]);

        ActionPlan::factory()->create([
            'user_id' => '1',
            'feedback_source_id' => '2',
            'feedback' => 'Teachers overall performance is below the threshold',
            'actions_to_be_taken' => 'One-on-one conference to teachers whose performance ratings is below the threshold of 4.0',
            'expected_compliance_period' => '2021-11-01 22:06:41',
            'status' => 'On-Going',
            'expected_outcome' => 'Improved performance in the next round of course assessment.',
            'means_of_verification' => 'Dean consultation with faculty form',
            'person_in_charge_id' => 1,
            'action_to' => 'Program',
            'action_to_id' => '3',
        ]);

        ActionPlan::factory()->create([
            'user_id' => '1',
            'feedback_source_id' => '3',
            'feedback' => 'STAs do not entertain us politely (suplada).',
            'actions_to_be_taken' => 'Re-orient STAs on how to build good relationship with students.',
            'expected_compliance_period' => '2021-11-21 22:06:41',
            'status' => 'Delayed',
            'expected_outcome' => 'No recurring incidents',
            'means_of_verification' => 'Minutes of meeting',
            'person_in_charge_id' => 1,
            'action_to' => 'College',
            'action_to_id' => '4',
        ]);
    }
}
