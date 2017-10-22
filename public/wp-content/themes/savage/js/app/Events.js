export default class Events {

    /**
     *
     */
    constructor() {
        /**
         * holds all event listeners
         * @type {Array}
         */
        this.listeners = [];
    }

    /**
     *  @chainable
     */
    addListener(name, callback) {
        this.listeners.push({
            name: name,
            callback: callback
        });
        return this;
    }

    /**
     *  @chainable
     */
    emit(name, context) {

        if (typeof name !== 'string') {
            // throw new error
        }

        var args = Array.prototype.splice.call(arguments, 2);

        this.listeners.forEach(function(listener, index, array) {
            for (var prop in listener) {
                if(listener.hasOwnProperty(prop)) {
                    if ((prop === 'name') && (listener[prop] === name)) {
                        listener.callback.apply(context || this, args);
                    }
                }
            }
        }.bind(this));

        return this;
    }
}