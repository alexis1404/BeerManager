Ext.define('BeerFront.model.Beer', {
    extend: 'Ext.data.Model',
    alias: 'Beer',
    fields: [
        {
            name: 'id'

        },
        {
            name: 'name'
        },
        {
            name: 'style'
        },
        {
            name: 'og'
        },
        {
            name: 'abv'
        },
        {
            name: 'ibu'
        },
        {
            name: 'volume'
        },
        {
            name: 'cost'
        },
        {
            name: 'status'
        },
        {
            name: 'providerName'
        }
    ],

    setVolume: function(value){
        this.set('volume', value);
    }
});