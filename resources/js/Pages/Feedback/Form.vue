<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm, Head } from "@inertiajs/vue3";

const form = useForm({
    
    content:"",
    source:"Feedier Form",
});
</script>

<template>
    <Head title="Feedbacks" />

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form
                @submit.prevent="
                    form.post(route('feedbacks.store'), {
                        onSuccess: () => form.reset(),
                    })
                "
            >
                <textarea
                    v-model="form.content"
                    placeholder="Your Feedback"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <!-- <div v-if="form.errors.content">{{ form.errors.content }}</div> -->
                <InputError :message="form.errors.message" class="mt-2" />
                <PrimaryButton class="mt-4">Send</PrimaryButton>
            </form>
            <!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->
        </div>
    </AuthenticatedLayout>
</template>
