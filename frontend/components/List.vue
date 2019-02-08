<template>
    <div class="field">
        <div class="ui multiple selection dropdown">
            <input type="hidden" :name="listName" ref="list" @change="updateValue">
            <i class="dropdown icon"></i>
            <div class="default text">{{placeholder}}</div>
            <div class="menu">
                <div class="item" v-for="item in items" :data-value="item.id">{{item.name}}</div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "list",
        props: {
            value: String,
            afterSelect: {
                type: Function,
                default: () => {}
            },
            listName: {
                type: String,
                required: true
            },
            items: {
                type: Array,
                required: true
            },
            placeholder: {
                type: String,
                default: '-- choose --'
            }
        },
        methods: {
            updateValue() {
                this.$emit('change', {
                    value: this.$refs.list.value
                })
            }
        }
    }
</script>