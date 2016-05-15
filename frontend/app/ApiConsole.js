export default class ApiConsole {
    constructor () {

    }

    get user() {
        // later this needs to be moved to the 'store' which represents the app state (aka model)
        return {
            id: 99,
            firstName: 'Rahi',
            lastName: 'Parsi'
        };
    }
}