<template>
    <div class="card">
        <div class="card-body">
            <form @submit.prevent="save()">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" class="form-control" v-model="title">
                </div>
                <div class="form-group">
                    <label for="thumb">Thumbnail</label><br>
                    <input type="file" name="thumb" id="thumb" @change="handleFile($event)">
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
        data() {
            return {
                title: '',
                content: '',
                file: null
            }
        },
        mounted() {
        },
        methods: {
            handleFile($event) {
                this.file = $event.target.files[0];
            },
            save() {
                let data = new FormData();
                data.append('title', this.title);
                data.append('content', this.content);
                data.append('thumb', this.file);

                console.log(this.file);
                console.log(data);

                window.axios
                    .post(
                        laroute.route('posts.store'),
                        data,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }
                    )
                    .then(response => {
                        if (response.status === 200) {
                            if (response.data.success) {
                                this.title = '';
                                this.content = '';
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