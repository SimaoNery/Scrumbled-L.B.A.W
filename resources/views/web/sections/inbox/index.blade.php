@extends('web.layout')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-4xl font-bold mb-8 text-center">Inbox</h1>
        <div class="mx-auto card" id="notificationList">
            @if ($notifications->isEmpty())
                <div class="flex flex-col items-center justify-center h-full mt-16 mb-16">
                    <x-lucide-mail-open class="text-gray-600" width="200" height="200"/>
                    <p class="text-gray-600 text-center mt-16"><strong><span class="text-2xl">Your inbox is empty!</span></strong><br><br>Time to plan, sprint, and conquer your next big goal..</p>
                </div>
            @else
                <div class="overflow-x-auto bg-white shadow-md rounded-lg p-6 mb-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-white border-b border-black rounded-t-lg">
                            <tr>
                                <th class="px-6 py-3 text-left text-lg font-bold text-primary uppercase tracking-wider rounded-tl-lg">
                                    Notification
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="results-container">
                            @foreach ($notifications as $notification)

                            @include('web.sections.inbox.components._notification', ['$notifications' => $notifications])
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    
@endsection

