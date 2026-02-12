<section>
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-8">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nombre')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                    required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                    required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Your email address is unverified.') }}
                            <button form="send-verification"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>
                    </div>
                @endif
            </div>

            <!-- DNI -->
            <div>
                <x-input-label for="dni" :value="__('DNI / CI')" />
                <x-text-input id="dni" name="dni" type="text" class="mt-1 block w-full" :value="old('dni', $user->dni)"
                    required />
                <x-input-error class="mt-2" :messages="$errors->get('dni')" />
            </div>

            <!-- Phone -->
            <div>
                <x-input-label for="phone" :value="__('Teléfono')" />
                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full"
                    :value="old('phone', $user->phone)" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>

            <!-- DOB -->
            <div>
                <x-input-label for="dob" :value="__('Fecha de Nacimiento')" />
                <x-text-input id="dob" name="dob" type="date" class="mt-1 block w-full" :value="old('dob', $user->dob ? \Carbon\Carbon::parse($user->dob)->format('Y-m-d') : '')"
                    required />
                <x-input-error class="mt-2" :messages="$errors->get('dob')" />
            </div>

            <!-- Sex -->
            <div>
                <x-input-label for="sex" :value="__('Género')" />
                <select id="sex" name="sex"
                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-sm font-bold text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none shadow-sm">
                    <option value="Male" {{ old('sex', $user->sex) == 'Male' ? 'selected' : '' }}>Masculino</option>
                    <option value="Female" {{ old('sex', $user->sex) == 'Female' ? 'selected' : '' }}>Femenino</option>
                    <option value="Other" {{ old('sex', $user->sex) == 'Other' ? 'selected' : '' }}>Otro</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('sex')" />
            </div>
        </div>

        <!-- Address -->
        <div>
            <x-input-label for="address" :value="__('Dirección')" />
            <textarea id="address" name="address" rows="3"
                class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-sm font-bold text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none shadow-sm">{{ old('address', $user->address) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar Cambios') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-emerald-500">{{ __('Información actualizada correctamente.') }}</p>
            @endif
        </div>
    </form>
</section>
