<?php

namespace App\Services;

use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmailService
{
    public static function send(
        string $templateKey,
        string $to,
        array $placeholders = [],
        array $options = []
    ): bool {

        $template = EmailTemplate::where(
            'template_key',
            $templateKey
        )
        ->where('is_active', true)
        ->first();

        if (!$template) {

            Log::error(
                "Email template not found: {$templateKey}"
            );

            return false;
        }

        $subject = $template->subject;
        $body = $template->body;

        foreach ($placeholders as $key => $value) {

            $body = str_replace(
                '{' . $key . '}',
                $value,
                $body
            );

            $subject = str_replace(
                '{' . $key . '}',
                $value,
                $subject
            );
        }

        try {

            Mail::send(
                'emails.master',
                [
                    'content' => $body,
                    'subject' => $subject
                ],
                function ($message) use (
                    $to,
                    $subject,
                    $options
                ) {

                    $message
                        ->to($to)
                        ->subject($subject);

                    if (!empty($options['cc'])) {
                        $message->cc($options['cc']);
                    }

                    if (!empty($options['bcc'])) {
                        $message->bcc($options['bcc']);
                    }

                    if (!empty($options['reply_to'])) {
                        $message->replyTo(
                            $options['reply_to']
                        );
                    }

                    if (!empty($options['attachments'])) {

                        foreach (
                            $options['attachments']
                            as $filename => $data
                        ) {

                            $message->attachData(
                                $data,
                                $filename,
                                [
                                    'mime' => 'application/pdf'
                                ]
                            );
                        }
                    }
                }
            );

            return true;

        } catch (\Throwable $e) {

            Log::error(
                'Email Sending Failed Exception',
                [
                    'template' => $templateKey,
                    'recipient' => $to,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]
            );

            return false;
        }
    }
}