<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { update } from '@/routes/password';

const props = defineProps<{
    token: string;
    email: string;
}>();

const inputEmail = ref(props.email);
</script>

<template>
    <AuthLayout
        title="Reset password"
        description="Please enter your new password below"
    >
        <Head title="Reset password" />

        <Form
            v-bind="update.form()"
            :transform="(data) => ({ ...data, token, email })"
            :reset-on-success="['password', 'password_confirmation']"
            v-slot="{ errors, processing }"
        >
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" autocomplete="email" v-model="inputEmail" class="mt-1 block w-full" readonly />
                    <div v-show="errors.email" class="validationErr">
                        {{ errors.email }}
                    </div>
                </div>

                <div class="grid gap-2">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" autocomplete="new-password" class="mt-1 block w-full" autofocus placeholder="Password" />
                    <div v-show="errors.password" class="validationErr">
                        {{ errors.password }}
                    </div>
                </div>

                <div class="grid gap-2">
                    <label for="password_confirmation">
                        Confirm Password
                    </label>
                    <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" class="mt-1 block w-full" placeholder="Confirm password" />
                    <div v-show="errors.password_confirmation" class="validationErr">
                        {{ errors.password_confirmation }}
                    </div>
                </div>

                <button type="submit" class="mt-4 w-full submitBtn" :disabled="processing" data-test="reset-password-button" >
                    <Spinner v-if="processing" />
                    Reset password
                </button>
            </div>
        </Form>
    </AuthLayout>
</template>
