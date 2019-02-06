<template>
    <div class="field">
        <div class="ui multiple selection dropdown">
            <input type="hidden" :name="listName">
            <i class="dropdown icon"></i>
            <div class="default text">{{placeholder}}</div>
            <div class="menu">
                <div class="item" v-for="item in items" :data-value="item.value">{{item.text}}</div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "list",
        props: {
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
        }
    }
</script>