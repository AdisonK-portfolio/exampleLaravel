<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { logout } from '@/routes';
import { send } from '@/routes/verification';
import { Link } from '@inertiajs/vue3';

defineProps<{
    status?: string;
}>();
</script>

<template>
    <AuthLayout
        title="Verify email"
        description="Please verify your email address by clicking on the link we just emailed to you."
    >
        <Head title="Email verification" />

        <div
            v-if="status === 'verification-link-sent'"
            class="mb-4 text-center text-sm font-medium text-green-600"
        >
            A new verification link has been sent to the email address you
            provided during registration.
        </div>

        <Form
            v-bind="send.form()"
            class="space-y-6 text-center"
            v-slot="{ processing }"
        >
            <button :disabled="processing" variant="secondary" class="submitBtn">
                <Spinner v-if="processing" />
                Resend verification email
            </button>

            <Link :href="logout()" as="button" class="mx-auto block text-sm" >
                Log out
            </Link>
        </Form>
    </AuthLayout>
</template>
