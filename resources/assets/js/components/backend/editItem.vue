<template>
    <el-form :model="addItemForm" :rules="rules" ref="addItemForm" label-width="100px" class="demo-addItemForm">
        <el-form-item label="商品名称" prop="name">
            <el-input v-model="addItemForm.name"></el-input>
        </el-form-item>


        <el-form-item label="商品分类" prop="category" required>
            <chose-cate v-on:sendCategory="handleCategory"></chose-cate>
        </el-form-item>


        <el-form-item label="商品成本" prop="cost_price" required>
            <el-input placeholder="请输入成本" v-model.number="addItemForm.cost_price">
                <template slot="append">元</template>
            </el-input>
        </el-form-item>

        <el-form-item label="商品价格" prop="now_price" required>
            <el-input placeholder="请输入价格" v-model.number="addItemForm.now_price">
                <template slot="append">元</template>
            </el-input>
        </el-form-item>

        <el-form-item label="商品数量" prop="number" required>
            <el-input placeholder="请输入数量" v-model.number="addItemForm.number">
                <template slot="append">件</template>
            </el-input>
        </el-form-item>


        <el-form-item label="是否推荐" prop="is_show">
            <el-switch on-text="" off-text="" v-model="addItemForm.is_show"></el-switch>
        </el-form-item>

        <!--<el-form-item label="商品标签" prop="tag">-->
            <!--<el-checkbox-group v-model="addItemForm.tag">-->
                <!--<el-checkbox label="美食/餐厅线上活动" name="tag"></el-checkbox>-->
                <!--<el-checkbox label="地推活动" name="tag"></el-checkbox>-->
                <!--<el-checkbox label="线下主题活动" name="tag"></el-checkbox>-->
                <!--<el-checkbox label="单纯品牌曝光" name="tag"></el-checkbox>-->
            <!--</el-checkbox-group>-->
        <!--</el-form-item>-->

        <el-form-item label="商品描述" prop="description">
            <quill-editor ref="myTextEditor"
                          v-model="addItemForm.description"
            >
            </quill-editor>
        </el-form-item>

        <el-form-item label="增加缩略图">
            <add-image></add-image>
        </el-form-item>

        <el-form-item>
            <el-button type="primary" @click="submitForm('addItemForm')">立即创建</el-button>
            <el-button @click="resetForm('addItemForm')">重置</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
    import ChoseCate from './choseCategory.vue'
    import {quillEditor} from 'vue-quill-editor'
    import AddImage from './addImage.vue'

    export default {
        components: {
            ChoseCate,
            quillEditor,
            AddImage
        },

        data() {
            return {
                addItemForm: {
                    name: '',
                    category: '',
                    cost_price:0 ,
                    now_price: 0,
                    number: 0,
                    is_show: false,
                    tag: [],
                    resource: '',
                    description: '<h1>this is example</h1>'
                },
                rules: {
                    name: [
                        {required: true, message: '请输入商品名称', trigger: 'blur'},
                        {min: 3, max: 150, message: '长度在 3 到 150 个字符', trigger: 'blur'}
                    ],
                    cost_price: [
                        {type: 'number', message: '请输入数字', trigger: 'blur'}
                    ],
                    now_price: [
                        {type: 'number', message: '请输入数字', trigger: 'blur'}
                    ],
                    number: [
                        {type: 'number', message: '请输入数字', trigger: 'blur'}
                    ],
//                    tag: [
//                        {type: 'array', required: true, message: '请至少选择一个标签', trigger: 'change'}
//                    ],
                    description: [
                        {required: true, message: '请填写商品描述', trigger: 'blur'}
                    ]
                }
            };
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        axios.put('/api/item/'+this.$route.params.itemId,{
                                data:this.addItemForm
                        })
                    } else {
                        return false;
                    }
                });
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            },
            handleCategory(data){
                console.log(data)
            }
        },
        created(){
            axios.get('/api/item/'+this.$route.params.itemId).then(res=>{
                this.addItemForm = res.data
            })
        }
    }
</script>
