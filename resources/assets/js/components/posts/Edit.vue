<template>
    <div class="card">
        <div class="card-body">
            <form @submit.prevent="save()">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" class="form-control" v-model="title">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea id="content" class="form-control" rows="5" v-model="content"></textarea>
                </div>
                <button class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['post'],
        data() {
            return {
                title: this.post.title,
                content: this.post.content
            }
        },
        mounted() {
            console.log(this.post);
        },
        methods: {
            save() {
                window.axios
                    .post(laroute.route('posts.update', {post: this.post.id}), {
                        title: this.title,
                        content: this.content
                    })
                    .then(response => {
                        if (response.status === 200) {
                            if (response.data.success) {
                                alert(response.data.message);
                            }
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        }
    }
</script>

<style scoped>

</style>