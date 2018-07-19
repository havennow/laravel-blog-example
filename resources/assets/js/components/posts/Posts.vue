<template>
    <div>
        <div class="col-xs-12 col-md-12 my-2" v-for="post of postsList">
            <div class="card">
                <div class="card-header clearfix">
                    <a :href="getEditUrl(post)" class="float-right">Edit</a>
                    <a href="#" class="float-right mr-1" @click.prevent="remove(post)">Delete</a>
                    {{post.title}} -
                    <small>{{moment(post.created_at).fromNow()}}</small>
                    <div>Por <span class="muted">{{post.author.name}}</span></div>
                </div>
                <div class="card-body">
                    <img v-if="post.thumb" :src="url + post.thumb" :alt="post.name" class="img-responsive img-thumbnail">
                    {{ post.content }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import swal from "sweetalert2";

    export default {
        data() {
            return {
                postsList: [],
                url: ''
            }
        },
        props: [
            'posts'
        ],
        name: "posts",
        mounted() {
            console.log(baseUrl);
            this.postsList = this.posts.data;
            this.url = baseUrl;
        },
        methods: {
            getEditUrl(post) {
                return laroute.route('posts.edit', {post: post.id});
            },
            getDeleteUrl(post) {
                return laroute.route('posts.destroy', {post: post.id});
            },
            remove(post) {
                let self = this;
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        window
                            .axios
                            .get(laroute.route('posts.destroy', {post: post.id}))
                            .then(response => {
                                if (response.status === 200) {
                                    if (response.data.success) {
                                        this.postsList = this.postsList.filter(p => {
                                            return p.id !== post.id;
                                        });

                                        swal(
                                            'Deleted!',
                                            response.data.message,
                                            'success'
                                        )
                                    }
                                }
                            });

                    }
                });
                console.log(post);
            }
        }
    }
</script>

<style scoped>

</style>