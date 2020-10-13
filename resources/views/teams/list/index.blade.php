<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Equipos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <livewire:users-table></livewire:users-table>
                <x-team-card>
                    <x-slot name="name">
                        Atlanta Hawks
                    </x-slot>
                    <x-slot name="img">
                        https://a2.espncdn.com/combiner/i?img=%2Fi%2Fteamlogos%2Fnba%2F500%2Fatl.png
                    </x-slot>
                </x-team-card>
                <x-team-card>
                    <x-slot name="name">
                        Miami Heat
                    </x-slot>
                    <x-slot name="img">
                        https://es.global.nba.com/media/img/teams/00/logos/MIA_logo.svg
                    </x-slot>
                </x-team-card>
                <x-team-card>
                    <x-slot name="name">
                        L.A. Lakers
                    </x-slot>
                    <x-slot name="img">
                        https://es.global.nba.com/media/img/teams/00/logos/LAL_logo.svg
                    </x-slot>
                </x-team-card>
                <x-team-card>
                    <x-slot name="name">
                        Charlotte Hornets
                    </x-slot>
                    <x-slot name="img">
                        https://es.global.nba.com/media/img/teams/00/logos/CHA_logo.svg
                    </x-slot>
                </x-team-card>
            </div>
            <div class="bg-white overflow-hidden shadow sm:rounded p-3">
                Lorem ipsum dolor, sit amet, consectetur adipisicing elit. Perferendis laudantium ab deleniti, libero doloremque nihil necessitatibus ipsa suscipit numquam distinctio excepturi temporibus non harum. Reprehenderit, repudiandae. Cumque odio alias iste!
            </div>
        </div>
    </div>
</x-app-layout>
