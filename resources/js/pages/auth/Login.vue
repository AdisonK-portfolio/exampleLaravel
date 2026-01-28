<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { Checkbox } from '@/components/ui/checkbox';
import { Spinner } from '@/components/ui/spinner';
import AuthBase from '@/layouts/AuthLayout.vue';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';
import { Link } from '@inertiajs/vue3';

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}>();
</script>

<template>
    <AuthBase
        title="Log in to your account"
        description="Enter your email and password below to log in"
    >
        <Head title="Log in" />

        <div
            v-if="status"
            class="mb-4 text-center text-sm font-medium text-green-600"
        >
            {{ status }}
        </div>

        <Form
            v-bind="store.form()"
            :reset-on-success="['password']"
            v-slot="{ errors, processing }"
            class="flex flex-col gap-6"
        >
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <label for="email">Email address</label>
                    <input id="email" type="email" name="email" required autofocus :tabindex="1" autocomplete="email" placeholder="email@example.com" />
                    <div v-show="errors.email" class="validationErr">
                        {{ errors.email }}
                    </div>
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <label for="password">Password</label>
                        <Link v-if="canResetPassword" :href="request()" class="text-sm" :tabindex="5" >
                            Forgot password?
                        </Link>
                    </div>
                    <input id="password" type="password" name="password" required :tabindex="2" autocomplete="current-password" placeholder="Password" />
                    <div v-show="errors.password" class="validationErr">
                        {{ errors.password }}
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember" class="flex items-center space-x-3">
                        <Checkbox id="remember" name="remember" :tabindex="3" />
                        <span>Remember me</span>
                    </label>
                </div>

                <button type="submit" class="mt-4 w-full submitBtn" :tabindex="4" :disabled="processing" data-test="login-button" >
                    <Spinner v-if="processing" />
                    Log in
                </button>
            </div>

            <div
                class="text-center text-sm text-muted-foreground"
                v-if="canRegister"
            >
                Don't have an account?
                <Link :href="register()" :tabindex="5">Sign up</Link>
            </div>
        </Form>
    </AuthBase>
</template>
