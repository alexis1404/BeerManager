Ext.define('BeerFront.store.Beers', {
    extend: 'Ext.data.Store',
    model: 'BeerFront.model.Beer',

    proxy: {
        type: 'ajax',
        batchActions: false,
        api: {
            read: 'http://localhost/BeerManager/web/app_dev.php/get_all_beers',
            destroy: 'http://localhost/BeerManager/web/app_dev.php/delete_beer',
            update: 'http://localhost/BeerManager/web/app_dev.php/edit_beer'
        },
        reader: {
            type: 'json',
            rootProperty: 'beers'
        }
    },
    autoLoad: true
});
