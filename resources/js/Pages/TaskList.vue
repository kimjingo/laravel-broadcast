<template>
    <div class="m-auto p-10 px-auto bg-yellow-200">
        <ul>
            <li v-for="task in tasks" v-text="task" class="border-spacing-5"></li>
        </ul>
        <input type="text" v-model="newTask" @blur="addTask">
    </div>
</template>
<script>
// import { Head, Link } from '@inertiajs/vue3';

export default{
    data(){
        return {
            tasks:[],
            newTask:''
        }
    },
    created(){
        axios.get('/tasks').then(response=>(this.tasks=response.data));

        // window.Echo.channel('tasks').listen('TaskCreated', e => {
        //     this.tasks.push(e.task.body);
        window.Echo.channel('tasks').listen('TaskCreated', ({task}) => {
            this.tasks.push(task.body);
        });
    },

    methods : {
        addTask(){
            axios.post('/tasks', {body:this.newTask});
            this.tasks.push(this.newTask);
            this.newTask = '';
        }
    }
}


</script>


<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
