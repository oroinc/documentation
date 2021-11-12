<template>
    <template v-if="editMode">
        <form class="grid">
            <div class="grid__row">
                <label for="name">Title</label>
                <input type="text" id="name" class="input" name="title" v-model="title">
            </div>
            <div class="grid__row">
                <label for="content">Content</label>
                <textarea class="input" id="content" name="content" v-model="content"></textarea>
            </div>
            <div class="grid__row">
                <button type="submit" class="btn btn-primary" @click.prevent="exitEditMode">Update</button>
            </div>
        </form>
    </template>

    <template v-else>
        <h1>{{ title }}</h1>
        <p>{{ content }}</p>

        <button class="btn edit-mode" @click.prevent="enterEditMode">Edit</button>
    </template>
</template>

<script>
export default {
    props: {
        initialTitle: {
            type: String,
            required: true
        },
        initialContent: {
            type: String,
            required: true
        }
    },

    data() {
        return {
            title: this.initialTitle,
            content: this.initialContent,
            editMode: false
        }
    },

    methods: {
        enterEditMode() {
            this.editMode = true;
        },

        exitEditMode() {
            this.editMode = false;
        }
    }
}
</script>
