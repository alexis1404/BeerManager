Ext.define('BeerFront.view.beerGrid.BeerGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'beerGrid',
    itemId: 'BeerGrid',
    id: 'bGrid',
    store: 'Beers',
    controller: 'beerGridController',
    margin: 10,
    selType: 'rowmodel',
    plugins:[{
        ptype:'rowediting',
        clicksToEdit: 2,
        pluginId: 'roweditingId'
    }],

    tbar: [
        {
            xtype: 'button',
            text: 'Save all changes',
            name: 'saveChangesButton_2',
            handler: 'saveAllChangesInBeersGrid'
        },
        {
            xtype: 'button',
            text: 'Add new beer',
            name: 'addNewBeerButton',
            handler: 'createBeer',
            id: 'addNewBeer_B1'
        }
    ],

    columns: [
        {
            header: 'Name',
            dataIndex: 'name',
            flex:1,
            editor: {
                allowBlank: false,
                xtype: 'textfield'
            }
        },
        {
            header: 'Style',
            dataIndex: 'style',
            flex:1,
            editor: {
                allowBlank: false,
                xtype: 'textfield'
            }
        },
        {
            header: 'OG',
            dataIndex: 'og',
            flex:1,
            editor: {
                allowBlank: false,
                xtype: 'numberfield'
            }
        },
        {
            header: 'ABV',
            dataIndex: 'abv',
            flex:1,
            editor: {
                allowBlank: false,
                xtype: 'numberfield'
            }
        },
        {
            header: 'IBU',
            dataIndex: 'ibu',
            flex:1,
            editor: {
                allowBlank: false,
                xtype: 'numberfield'
            }
        },
        {
            header: 'Volume',
            dataIndex: 'volume',
            flex:1,
            editor: {
                allowBlank: false,
                xtype: 'numberfield'
            }
        },
        {
            header: 'Cost',
            dataIndex: 'cost',
            flex:1,
            editor: {
                allowBlank: false,
                xtype: 'numberfield'
            }
        },
        {
            header: 'Status',
            dataIndex: 'status',
            flex:1,
            editor: {
                allowBlank: false,
                xtype: 'numberfield'
            }
        },
        {
            header: 'Producer',
            dataIndex: 'providerName',
            flex:1,
            editor: {
                xtype: 'textfield'
            }
        },
        {
            xtype: 'actioncolumn',
            flex: 1,
            header: 'DEL',
            items: [{
                icon: 'images/delete.png',
                handler: 'del_beer'
            }]
        }

    ]
});