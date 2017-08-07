Ext.define('BeerFront.store.Producers', {
    extend: 'Ext.data.Store',
    model: 'BeerFront.model.Producer',

    proxy: {
        type: 'ajax',
        batchActions: false,
        api: {
            read: 'http://localhost/BeerManager/web/app_dev.php/get_all_producers',
            destroy: 'http://localhost/BeerManager/web/app_dev.php/delete_producer',
            update: 'http://localhost/BeerManager/web/app_dev.php/edit_producer',
            create:  'http://localhost/BeerManager/web/app_dev.php/create_producer'
        },
        reader: {
            type: 'json',
            rootProperty: 'producers'
        }
    },
    autoLoad: true
});
