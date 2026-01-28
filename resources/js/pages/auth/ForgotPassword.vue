<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { login } from '@/routes';
import { email } from '@/routes/password';
import { Link } from '@inertiajs/vue3';

defineProps<{
    status?: string;
}>();
</script>

<template>
    <AuthLayout
        title="Forgot password"
        description="Enter your email to receive a password reset link"
    >
        <Head title="Forgot password" />

        <div
            v-if="status"
            class="mb-4 text-center text-sm font-medium text-green-600"
        >
            {{ status }}
        </div>

        <div class="space-y-6">
            <Form v-bind="email.form()" v-slot="{ errors, processing }">
                <div class="grid gap-2">
                    <label for="email">Email address</label>
                    <input id="email" type="email" name="email" autocomplete="off" autofocus placeholder="email@example.com" />
                    <div v-show="errors.email" class="validationErr">
                        {{ errors.email }}
                    </div>
                </div>

                <div class="my-6 flex items-center justify-start">
                    <button class="w-full submitBtn" :disabled="processing" data-test="email-password-reset-link-button">
                        <Spinner v-if="processing" />
                        Email password reset link
                    </button>
                </div>
            </Form>

            <div class="space-x-1 text-center text-sm text-muted-foreground">
                <span>Or, return to</span>
                <!-- <a href="/login">log in</a> -->
                <Link :href="login()">
                    Log in
                </Link>
            </div>
        </div>
    </AuthLayout>
</template>
