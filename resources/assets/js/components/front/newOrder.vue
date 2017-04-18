<template>
    <el-row>
        <el-col :span="14">
            <el-tabs type="border-card">
                <el-tab-pane :label="order.order_id">
                    <el-form ref="order" :model="order" label-width="100px">
                        <!--nickname-->
                        <el-form-item label="昵称：">
                            <el-input :disabled="true" v-model="order.nickname"></el-input>
                        </el-form-item>
                        <!--tel-->
                        <el-form-item label="Tel：">
                            <el-input :disabled="true" v-model="order.tel"></el-input>
                        </el-form-item>
                        <!--收货地址-->
                        <el-form-item label="收货地址：">
                            <el-input :disabled="true" v-model="order.address"></el-input>
                        </el-form-item>
                        <!--商品名称-->
                        <el-form-item label="商品名称：">
                            <el-input :disabled="true" v-model="order.title"></el-input>
                        </el-form-item>
                        <!--数量-->
                        <el-form-item label="商品名称：">
                            <Input-number :max="order.max_number" :min="1" v-model="order.item_num"></Input-number>
                        </el-form-item>
                        <!--商品总价-->
                        <el-form-item label="商品总价：">
                            {{order.now_price*order.item_num}}元
                        </el-form-item>
                        <!--选择快递-->
                        <el-form-item label="选择快递：">
                            <el-select v-model="order.kd_company" placeholder="请选择">
                                <el-option
                                        v-for="item in options"
                                        :label="item.label"
                                        :value="item.value"
                                >
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-button type="primary" @click="submitForm">立即下单</el-button>
                    </el-form>
                </el-tab-pane>
            </el-tabs>
        </el-col>
    </el-row>
</template>

<script>
    import KdCompany from '../utils/kd_company.vue'
    export default{
        components: {
            KdCompany
        },
        data(){
            return {
                itemId: '',
                userId: '',
                num: '',
                order: {
                    order_id: '',
                    nickname: '',
                    tel: '',
                    address: '',
                    title: '',
                    item_num: 0,
                    total_price: 0,
                    max_number: 0,
                    now_price: 0,
                    kd_company: '',
                },
                options: [{
                    value: 'HTKY',
                    label: '百世快递'
                }, {
                    value: 'SF',
                    label: '顺丰快递'
                }, {
                    value: 'STO',
                    label: '申通快递'
                }, {
                    value: 'YTO',
                    label: '圆通速递'
                }]
            }
        },
        methods: {
            submitForm(){
                axios.post('/api/user/new_order', {order: this.order}).then(res => {
                    if (res.data.code == '200') {
                        this.$notify({
                            title: '下单成功',
                            message: '恭喜您，下单成功。',
                            type: 'success'
                        })
                    }
                }).catch(err => {
                    this.$notify({
                        title: '下单失败',
                        message: res.data.err_msg,
                        type: 'error'
                    });
                    }
                )
            }
        },
        created()
        {
            this.itemId = this.$route.params.itemId
            this.userId = sessionStorage.getItem('user-id')
            this.num = this.$route.params.itemNum
            axios.get('/api/user/new_order', {
                params: {
                    item_number: this.num,
                    item_id: this.itemId
                }
            }).then(res => {
                this.order.nickname = res.data.user_info[0].nickname
                this.order.tel = res.data.user_info[0].tel
                this.order.address = res.data.address['0'].province + "/" + res.data.address['0'].city + "/" + res.data.address['0'].detail
                this.order.title = res.data.user_order['0'].item_title
                this.order.item_num = res.data.user_order['0'].item_number
                this.order.order_id = "订单ID：" + res.data.user_order['0'].order_id
                this.order.total_price = res.data.user_order['0'].total_price
                this.order.max_number = res.data.user_order['0'].max_num.number
                this.order.now_price = res.data.user_order['0'].max_num.now_price
            })
        }
    }
</script>