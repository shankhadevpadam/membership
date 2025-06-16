<x-layouts.app :title="__('Dashboard')">
    <div class="mb-8 animate-fade-in">
        <h1 class="text-4xl font-bold text-slate-800">{{ __('Dashboard') }}</h1>
    </div>

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-4 mb-10">
            <div
                class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 rounded-xl text-white __web-inspector-hide-shortcut__">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100">Membership Status</p>
                        <p class="text-2xl font-bold">Active</p>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-r from-green-500 to-green-600 p-6 rounded-xl text-white __web-inspector-hide-shortcut__">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100">Membership Status</p>
                        <p class="text-2xl font-bold">Active</p>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-r from-purple-500 to-purple-600 p-6 rounded-xl text-white __web-inspector-hide-shortcut__">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100">Membership Status</p>
                        <p class="text-2xl font-bold">Active</p>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-r from-orange-500 to-orange-600 p-6 rounded-xl text-white __web-inspector-hide-shortcut__">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100">Membership Status</p>
                        <p class="text-2xl font-bold">Active</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <h3 class="text-lg font-semibold mb-4">Upcoming Events</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <h4 class="font-medium text-gray-900">Shivaratri Celebration</h4>
                            <p class="text-sm text-gray-500">2025-02-26 at 18:00</p>
                            <p class="text-sm text-green-600">Free for Members</p>
                        </div><button
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Register</button>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <h4 class="font-medium text-gray-900">Holi Festival</h4>
                            <p class="text-sm text-gray-500">2025-03-14 at 16:00</p>
                            <p class="text-sm text-green-600">Free for Members</p>
                        </div><button
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Register</button>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <h4 class="font-medium text-gray-900">Community Fundraiser</h4>
                            <p class="text-sm text-gray-500">2025-03-20 at 19:00</p>
                            <p class="text-sm text-green-600">$25 Non-Members</p>
                        </div><button
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Register</button>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <h3 class="text-lg font-semibold mb-4">Recent Payments</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <h4 class="font-medium text-gray-900">Membership Fee</h4>
                            <p class="text-sm text-gray-500">2024-01-15</p>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-gray-900">$10,000</p>
                            <p class="text-sm text-green-600">Completed</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <h4 class="font-medium text-gray-900">Event Ticket</h4>
                            <p class="text-sm text-gray-500">2024-02-01</p>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-gray-900">$50</p>
                            <p class="text-sm text-green-600">Completed</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
