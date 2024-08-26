define(
    [],
    function () {
        'use strict';
        return {
            getRules: function() {
                console.log('Validating custom shipping rates');
                return {
                    'postcode': {
                        'required': true
                    },
                    'country_id': {
                        'required': true
                    },
                    'city': {
                        'required': true
                    }
                };
            }
        };
    }
)
