<template>
    <div class="row" style="margin-top: 15px">
        <h3 class="text-center">{{ numberOfPartipants }}</h3>
        <button class="btn center-block" style="margin-bottom: 15px;" @click="changeCaptureParticipants()">
            {{ buttonLabel }}
        </button>
        <div v-for="user in this.users">
            <a style="text-decoration: none; color: grey" :href="'/benevoles/' + user.id + '/edit'">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <h3>{{ user.name }}</h3>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'users',
            'current_user'
        ],

        data() {
            return {

            }
        },

        methods : {
            changeCaptureParticipants : function () {
                this.$http.post('/captures/attach', {user_id: this.current_user.id})
                    .then((response) => {
                        console.log(response)
                    })
            }
        },

        computed: {
            numberOfPartipants : function () {
                if (this.users.length > 1)
                    return this.users.length + ' Participants'

                return this.users.length + ' Participant'
            },

            buttonLabel : function () {
                let user = this.users.find(user => user.email === this.current_user.email)

                if (user === undefined) {
                    return "Je participe"
                }

                return 'Ne plus participer'
            }

        },
    }
</script>
