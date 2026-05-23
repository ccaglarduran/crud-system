<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Ana Karşılama ve İstatistik Paneli -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-6">
                    
                    <!-- Karşılama Yazısı -->
                    <div class="text-sm font-medium text-gray-600 pb-2 border-b border-gray-100">
                        {{ __("You're logged in!") }}
                    </div>

                    <!-- Alt Alta Minimal İstatistik Kartları -->
                    <div class="space-y-4">
                        
                        <!-- 1. Toplam Hesap Sayısı -->
                        <div class="p-5 rounded-xl border border-gray-100 bg-gray-50/50 flex items-center justify-between">
                            <div class="space-y-0.5">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Accounts</p>
                                <h4 class="text-2xl font-bold text-gray-900">
                                    {{ \App\Models\User::count() }}
                                </h4>
                            </div>
                            <div class="p-2.5 bg-indigo-50 text-indigo-600 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                        </div>

                        <!-- 2. Yönetici (Admin) Sayısı -->
                        <div class="p-5 rounded-xl border border-gray-100 bg-gray-50/50 flex items-center justify-between">
                            <div class="space-y-0.5">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Administrators</p>
                                <h4 class="text-2xl font-bold text-amber-600">
                                    {{ \App\Models\User::where('email', 'like', '%admin%')->orWhere('id', 1)->count() }}
                                </h4>
                            </div>
                            <div class="p-2.5 bg-amber-50 text-amber-600 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                        </div>

                        <!-- 3. Standart Kullanıcı Sayısı -->
                        <div class="p-5 rounded-xl border border-gray-100 bg-gray-50/50 flex items-center justify-between">
                            <div class="space-y-0.5">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Regular Users</p>
                                <h4 class="text-2xl font-bold text-gray-800">
                                    {{ \App\Models\User::count() - (\App\Models\User::where('email', 'like', '%admin%')->orWhere('id', 1)->count()) }}
                                </h4>
                            </div>
                            <div class="p-2.5 bg-sky-50 text-sky-600 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                        </div>

                    </div>

                    <!-- Sunucu Adresi Bilgisi (YENİ EKLENEN YER) -->
                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                        <span class="font-medium">Active Server Node Address:</span>
                        <span class="font-mono bg-slate-100 px-2 py-1 rounded text-slate-600 select-all">
                            {{ Request::getHttpHost() }}
                        </span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
