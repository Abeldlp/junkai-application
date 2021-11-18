import { reactive } from 'vue'

const store = reactive({
    authUser: {}
})

interface ID {
    id: number,
}

interface User extends ID {
    name: string,
    email: string
}

const updateAuthUser = (user: User): User => {
    return store.authUser = {
        id: user.id,
        name: user.name,
        email: user.email
    }
}

export {
    store,
    updateAuthUser
}
