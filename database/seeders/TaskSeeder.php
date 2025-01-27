<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;


class TaskSeeder extends Seeder
{
    public function run()
    {
        // Create a test user
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('12345678'),
        ]);
        $statuses = ['pending', 'in-progress', 'completed'];

        $tasks = [
            
            [
                'title' => 'Code Review',
                'description' => 'Conduct peer review of new authentication feature',
                'due_date' => Carbon::today()->addDays(3),
            ],
            [
                'title' => 'Budget Planning',
                'description' => 'Prepare next quarter\'s department budget proposal',
                'due_date' => Carbon::today()->addDays(6),
            ],
            [
                'title' => 'User Testing Session',
                'description' => 'Organize and conduct usability testing for new feature',
                'due_date' => Carbon::today()->addDays(7),
            ],
            [
                'title' => 'Security Audit',
                'description' => 'Perform annual security audit and vulnerability scan',
                'due_date' => Carbon::today()->addDays(10),
            ],
            [
                'title' => 'Documentation Update',
                'description' => 'Update API documentation for recent changes',
                'due_date' => Carbon::today()->addDays(2),
            ],
            [
                'title' => 'Customer Feedback Analysis',
                'description' => 'Analyze recent survey results and create report',
                'due_date' => Carbon::today()->addDays(4),
            ],
            [
                'title' => 'Inventory Management',
                'description' => 'Conduct quarterly equipment inventory check',
                'due_date' => Carbon::today()->addDays(8),
            ],
            [
                'title' => 'Marketing Strategy Meeting',
                'description' => 'Plan next quarter\'s digital marketing initiatives',
                'due_date' => Carbon::today()->addDays(5),
            ],
            [
                'title' => 'Performance Optimization',
                'description' => 'Identify and fix database performance bottlenecks',
                'due_date' => Carbon::today()->addDays(3),
            ],

            [
                'title' => 'Client Onboarding',
                'description' => 'Prepare onboarding materials for new clients',
                'due_date' => Carbon::today()->addDays(2),
            ],
            [
                'title' => 'SEO Audit',
                'description' => 'Conduct SEO audit for the company website',
                'due_date' => Carbon::today()->addDays(4),
            ],
            [
                'title' => 'Product Launch Plan',
                'description' => 'Develop a plan for the upcoming product launch',
                'due_date' => Carbon::today()->addDays(6),
            ],
            [
                'title' => 'Team Building Activity',
                'description' => 'Organize a team-building event for the department',
                'due_date' => Carbon::today()->addDays(10),
            ],
            [
                'title' => 'Client Feedback Session',
                'description' => 'Schedule a session to gather client feedback',
                'due_date' => Carbon::today()->addDays(3),
            ],
            [
                'title' => 'Data Backup',
                'description' => 'Perform a full backup of all company data',
                'due_date' => Carbon::today()->addDays(5),
            ],
            [
                'title' => 'Website Performance Review',
                'description' => 'Analyze website performance metrics and report findings',
                'due_date' => Carbon::today()->addDays(7),
            ],
            [
                'title' => 'New Hire Orientation',
                'description' => 'Conduct orientation for new employees',
                'due_date' => Carbon::today()->addDays(1),
            ],
            [
                'title' => 'Email Marketing Campaign',
                'description' => 'Create and launch email marketing campaign for new product',
                'due_date' => Carbon::today()->addDays(8),
            ],
            [
                'title' => 'Compliance Training',
                'description' => 'Organize compliance training for all employees',
                'due_date' => Carbon::today()->addDays(9),
            ],
        ];

        foreach ($tasks as $index => $task) {
            Task::create([
                'user_id' => $user->id, 
                'title' => $task['title'],
                'description' => $task['description'],
                'due_date' => $task['due_date'],
                'status' => $statuses[$index % 3],
                'created_at' => Carbon::now()->subDays(rand(1, 30))
            ]);
        }
    }
}
