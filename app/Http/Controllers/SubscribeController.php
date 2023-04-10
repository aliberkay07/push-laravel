<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Minishlink\WebPush\WebPush;

class SubscribeController extends Controller
{


    public function store(Request $request)
    {
        $subs = $request->all();


        $checkEndpoint = Subscription::where('endpoint', $subs['endpoint'])->exists();
        $checkAuth = Subscription::where('auth_token', $subs['keys']['auth'])->exists();
        if ($checkEndpoint && $checkAuth) {
            return response()->json([
                'message' => 'Already subscribed.',
                'status' => false
            ], 201);
        }

        $subscription = new Subscription();
        $subscription->endpoint = $subs['endpoint'];
        $subscription->public_key = $subs['keys']['p256dh'];
        $subscription->auth_token = $subs['keys']['auth'];
        $subscription->content_encoding = 'aesgcm';
        $subscription->category_id = 1;
        $subscription->save();
        return response()->json([
            'message' => 'Subscribed successfully.',
            'status' => true,
            201]);

    }


    public function sendNotifications()
    {

        $subscription = Subscription::first();


        // Create a new Subscription instance.
        $subscription = \Minishlink\WebPush\Subscription::create([
            'endpoint' => $subscription->endpoint,
            'publicKey' => $subscription->public_key,
            'authToken' => $subscription->auth_token,
            'contentEncoding' => $subscription->content_encoding
        ]);

        $webPush = new WebPush(
            [
                'VAPID' => [
                    'subject' => config('webpush.vapid.subject'),
                    'publicKey' => config('webpush.vapid.public_key'),
                    'privateKey' => config('webpush.vapid.private_key')
                ]
            ]
        );


        $payload = json_encode([
            'title' => 'Push notification',
            'body' => 'This is a push notification',
            'icon' => '/images/icon.png',
            'badge' => '/images/badge.png'
        ]);


        $report = $webPush->sendOneNotification(
            $subscription,
            $payload);


        dd($report);

        foreach ($webPush->flush() as $report) {
            if (!$report['success']) {
                error_log('Push notification failed: ' . $report['statusCode']);
            }
        }

        return response()->json([
            'message' => 'Push notification sent.'
        ]);

    }


}
