<template>
    <el-form ref="form" :model="form" label-width="100px">
        <el-form-item label="评论昵称：">
            <el-input v-model="form.nickname"></el-input>
        </el-form-item>
        <el-form-item label="收货地址：">
            <!--<el-col :span="2">-->
                <!--<el-button type="primary" icon="edit" size="mini" @click="editEnable"></el-button>-->
            <!--</el-col>-->
            <el-col :span="22">
                <select-address
                        :province="province"
                        :city="city"
                        :detail="detail"
                        @change="handleChange">
                </select-address>
            </el-col>
        </el-form-item>
        <el-form-item>
            <el-button type="primary" @click="onSubmit">立即创建</el-button>
            <el-button>取消</el-button>
        </el-form-item>
    </el-form>
</template>
<script>
    import SelectAddress from './selectAddress.vue'
    export default {
        components: {SelectAddress},
        data() {
            return {
                form: {
                    nickname: '',
                    province: '',
                    city: '',
                    detail: ''
                }
            }
        },
        methods: {
            onSubmit() {
                console.log('submit!');
            },
            handleChange: function (val) {
                console.log(val);
            }
        },
        created(){
            this.province = '北京市'
            this.city = '县'
            this.detail='aaaa'
        }
    }
</script>