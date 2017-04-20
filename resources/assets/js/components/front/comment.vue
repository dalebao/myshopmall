<template>
    <div>
        <comment-list :msg="msg"></comment-list>
        <el-form ref="form" :model="form" label-width="80px">
            <el-form-item label="昵称">
                <el-row :gutter="20">
                    <el-col :span="10" v-if="!form.is_anonymous">
                        {{form.name}}
                    </el-col>
                    <el-col :span="10" v-if="form.is_anonymous">
                        {{form.nickname}}
                    </el-col>
                    <el-col :span="12">
                        <el-checkbox label="昵称评论" name="type" v-model="form.is_anonymous"></el-checkbox>
                    </el-col>
                </el-row>
            </el-form-item>
            <el-form-item label="评分">
                <el-rate
                        show-text
                        v-model="form.score"
                        :colors="['#99A9BF', '#F7BA2A', '#FF9900']">
                </el-rate>
            </el-form-item>
            <el-form-item label="评论">
                <el-col :span="15">
                    <el-input type="textarea" v-model="form.comment"></el-input>
                </el-col>
            </el-form-item>
            <el-button type="primary" @click="publishComment">发表</el-button>
        </el-form>
    </div>
</template>

<script>
    import CommentList from './commentList.vue'
    export default{
        components: {CommentList},
        data(){
            return {
                form: {
                    name: 'isisisisi',
                    is_anonymous: true,
                    score: null,
                    comment: null,
                    item_id: null,
                    nickname: ''
                },
                msg: [
                    {
                        name: '123',
                        score: 1,
                        comment: 'asdasa'
                    }, {
                        name: '12314',
                        score: 5,
                        comment: '123124asdafa'
                    }
                ]
            }
        },
        methods: {
            publishComment(){
                if (sessionStorage.getItem('user-name') == null) {
                    this.$alert('请先登录', '标题名称', {
                        confirmButtonText: '确定',
                        callback: action => {
                            this.$router.push('/user-login')
                        }
                    });
                } else {
                    axios.post('/api/user/comment', {
                        data: this.form,
                        item_id: this.item_id
                    });
                }
            }
        },
        created(){
            console.log(sessionStorage.getItem('user-name'))
            axios.get('/api/front/comment/' + this.$route.params.itemId).then(res => {
                this.msg = res.data
            })
            this.form.item_id = this.$route.params.itemId
            console.log(this.$route.params.itemId)
            if (sessionStorage.getItem('user-name') == null || sessionStorage.getItem('user-name') == "undefined") {
                this.form.name = "请先登陆！"
            } else {
                this.form.name = sessionStorage.getItem('user-name')
            }
            if (sessionStorage.getItem('user-name') == null || sessionStorage.getItem('user-name') == "undefined") {
                this.form.nickname = "请先登陆！"
            } else {
                this.form.nickname = sessionStorage.getItem('user-name')
            }
        }
    }
</script>
