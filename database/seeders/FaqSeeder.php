<?php

namespace Database\Seeders;

use App\Models\Faqs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
     $faqs = [
            [
                'question' => 'How do I create an account?',
                'answer' => 'Click the Sign Up button, fill in your details, and verify your email address to activate your account.',
            ],
            [
                'question' => 'How can I reset my password?',
                'answer' => 'Go to the login page, click "Forgot Password", enter your email, and follow the instructions sent to your inbox.',
            ],
            [
                'question' => 'How do I update my profile?',
                'answer' => 'Navigate to your profile settings, edit the desired information, and click Save Changes.',
            ],
            [
                'question' => 'Can I change my email address?',
                'answer' => 'Yes. Open your account settings, update your email address, and verify the new email.',
            ],
            [
                'question' => 'How do I contact customer support?',
                'answer' => 'You can contact our support team through the Contact Us page or by emailing support@example.com.',
            ],
            [
                'question' => 'How can I delete my account?',
                'answer' => 'Go to Account Settings, choose Delete Account, and confirm your decision. This action cannot be undone.',
            ],
            [
                'question' => 'Is my personal information secure?',
                'answer' => 'Yes, we use industry-standard security measures to protect your personal information and data.',
            ],
            [
                'question' => 'Can I use the platform on mobile devices?',
                'answer' => 'Yes, our platform is fully responsive and works on smartphones, tablets, and desktop devices.',
            ],
            [
                'question' => 'Do you offer refunds?',
                'answer' => 'Refund requests are handled according to our refund policy. Please contact support for assistance.',
            ],
            [
                'question' => 'How do I change my password?',
                'answer' => 'Visit Account Settings, select Change Password, enter your current password, then set a new one.',
            ],
        ];

        foreach ($faqs as $faq) {
            Faqs::create($faq);
        }
    
    }
}
