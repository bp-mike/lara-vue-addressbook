<template>
    <div>
    <h1>Contacts</h1>
    <form action="#" @submit.prevent="edit ? updateContact(contact.id) : createContact()">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" v-model="contact.name">
        </div>
        <div class="form-group">
            <label>email</label>
            <input type="email" name="email" class="form-control" v-model="contact.email">
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="number" name="phone" class="form-control" v-model="contact.phone">
        </div>
        <div class="form-group">
            <button type="submit" v-show="!edit" class="btn btn-primary">New Contact</button>
            <button type="submit" v-show="edit" class="btn btn-primary">update Contact</button>
        </div>
    </form>
    <h1>Contacts</h1>
    <ul class="list-group">
        <li class="list-group-item" v-for="contact in list">
            <strong>{{ contact.name }}</strong>
            {{ contact.email }}
            {{ contact.phone }}
            <button @click="showContact(contact.id)" class="btn btn-xs btn-success">Edit</button>
            <button @click="deleteContact(contact.id)" class="btn btn-xs btn-danger">Delete</button>
        </li>
    </ul>
</div>
</template>

<script>
    export default{
        data: function(){
            return {
                edit: false,
                list:[],
                contact:{
                    id:'',
                    name:'',
                    email:'',
                    phone:''
                }
            }
        },
        mounted: function(){
            console.log('contacts component loaded');
            this.fetchContactList();
        },
        methods:{
            fetchContactList: function(){
                axios.get('api/contacts').then((response)=>{
                    console.log(response.data)
                    this.list = response.data;
                }).catch((error)=>{
                    console.log(error)
                })
            },
            createContact: function(){
                console.log('creating contact')
                const self = this;
                const params = Object.assign({}, self.contact);
                axios.post('api/contacts/store', params).then(()=>{
                    self.contact.name='';
                    self.contact.email='';
                    self.contact.phone='';
                    self.edit = false;
                    self.fetchContactList();
                }).catch((error)=>{
                    console.log(error);
                });
            },
            showContact: function(id){
                axios.get('api/contacts/'+id).then((response)=>{
                    this.contact.id = response.data.id;
                    this.contact.name = response.data.name;
                    this.contact.email = response.data.email;
                    this.contact.phone = response.data.phone;

                    this.edit = true;
                }).catch((error)=>{
                    console.log(error)
                })
            },
            updateContact: function(id){
                console.log('updating contact')
                const self = this;
                const params = Object.assign({}, self.contact);
                axios.patch('api/contacts/'+id, params).then(()=>{
                    self.contact.name='';
                    self.contact.email='';
                    self.contact.phone='';
                    self.edit = false;
                    self.fetchContactList();
                }).catch((error)=>{
                    console.log(error);
                });
            },
            deleteContact: function(id){
                axios.delete('api/contacts/'+id).then((response)=>{
                    this.fetchContactList();
                }).catch((error)=>{
                    console.log(error);
                })
            }
        }
    }
</script>
