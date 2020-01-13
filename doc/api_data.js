define({ "api": [
  {
    "type": "get",
    "url": "/v1/category",
    "title": "Список категорий",
    "name": "Category",
    "group": "Category",
    "version": "1.0.0",
    "filename": "./modules/v1/controllers/CategoryController.php",
    "groupTitle": "Category",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/category"
      }
    ]
  },
  {
    "type": "get",
    "url": "/v1/country",
    "title": "Список стран",
    "name": "Country",
    "group": "Country",
    "version": "1.0.0",
    "filename": "./modules/v1/controllers/CountryController.php",
    "groupTitle": "Country",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/country"
      }
    ]
  },
  {
    "type": "get",
    "url": "/v1/district",
    "title": "Список районов",
    "name": "District",
    "group": "District",
    "version": "1.0.0",
    "filename": "./modules/v1/controllers/DistrictController.php",
    "groupTitle": "District",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/district"
      }
    ]
  },
  {
    "type": "post",
    "url": "/v1/event",
    "title": "Создание мероприятия",
    "name": "Create",
    "group": "Event",
    "version": "1.0.0",
    "permission": [
      {
        "name": "administrator"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-type",
            "description": "<p>MIME тип ресурса, например: application/json or application/xml.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>token авторизации.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Пример заголовка:",
          "content": "\"Content-type\": \"application/json\"\n\"Authorization\": \"Bearer BJHTN8rL9PfemW3Ws5shZK90jYh-RZ3QOXXDD9M3lXPe-GDE1pOPaHfN_JTxQprV\"",
          "type": "String"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "organization_id",
            "description": "<p>ID организации</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "locality_id",
            "description": "<p>ID населенного пункта</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "category_id",
            "description": "<p>ID категории</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>Название мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "introtext",
            "description": "<p>Краткое описание мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "description",
            "description": "<p>Подробное описание мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "image",
            "description": "<p>URL картинки мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "gallery",
            "description": "<p>Список URL картинок мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "video",
            "description": "<p>URL видео мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "address",
            "description": "<p>Адрес места проведения мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "phone",
            "description": "<p>Контактный телефон ответсвенного мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "email",
            "description": "<p>Электронная почта ответсвенного мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "contact",
            "description": "<p>ФИО ответсвенного мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "published",
            "description": "<p>Статус публикации мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "Unixtime",
            "optional": false,
            "field": "date",
            "description": "<p>Дата начала мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "time",
            "description": "<p>Время начала мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "tags",
            "description": "<p>Теги мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "latitude",
            "description": "<p>Широта на карте места проведения мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "longitude",
            "description": "<p>Долгота на карте места проведения мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "json",
            "optional": true,
            "field": "form",
            "description": "<p>Форма заявки мероприятия</p>"
          }
        ]
      }
    },
    "filename": "./modules/v1/controllers/EventController.php",
    "groupTitle": "Event",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/event"
      }
    ]
  },
  {
    "type": "delete",
    "url": "/v1/event/{id}",
    "title": "Удаление мероприятия",
    "description": "<p>Для удаления мероприятия нажно передать {id} - ID мероприятия в URL</p>",
    "name": "Delete",
    "group": "Event",
    "version": "1.0.0",
    "permission": [
      {
        "name": "administrator"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-type",
            "description": "<p>MIME тип ресурса, например: application/json or application/xml.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>token авторизации.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Пример заголовка:",
          "content": "\"Content-type\": \"application/json\"\n\"Authorization\": \"Bearer BJHTN8rL9PfemW3Ws5shZK90jYh-RZ3QOXXDD9M3lXPe-GDE1pOPaHfN_JTxQprV\"",
          "type": "String"
        }
      ]
    },
    "filename": "./modules/v1/controllers/EventController.php",
    "groupTitle": "Event",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/event/{id}"
      }
    ]
  },
  {
    "type": "get",
    "url": "/v1/event/filter/{organization|locality|category}/{id}",
    "title": "Фильтрация списка мероприятий",
    "name": "Filter",
    "group": "Event",
    "version": "1.0.0",
    "permission": [
      {
        "name": "none"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "allowedValues": [
              "application/json",
              "application/xml"
            ],
            "optional": false,
            "field": "Content-type",
            "defaultValue": "application/json",
            "description": "<p>MIME тип ресурса.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Пример заголовка:",
          "content": "\"Content-type\": \"application/json\"",
          "type": "String"
        }
      ]
    },
    "filename": "./modules/v1/controllers/EventController.php",
    "groupTitle": "Event",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/event/filter/{organization|locality|category}/{id}"
      }
    ]
  },
  {
    "type": "get",
    "url": "/v1/event/{id}/request",
    "title": "Список заявок на мероприятие",
    "description": "<p>Для получения списка заявок мероприятия нажно передать {id} - ID мероприятия в URL</p>",
    "name": "Request",
    "group": "Event",
    "version": "1.0.0",
    "permission": [
      {
        "name": "administrator"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-type",
            "description": "<p>MIME тип ресурса, например: application/json or application/xml.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>token авторизации.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Пример заголовка:",
          "content": "\"Content-type\": \"application/json\"\n\"Authorization\": \"Bearer BJHTN8rL9PfemW3Ws5shZK90jYh-RZ3QOXXDD9M3lXPe-GDE1pOPaHfN_JTxQprV\"",
          "type": "String"
        }
      ]
    },
    "filename": "./modules/v1/controllers/EventController.php",
    "groupTitle": "Event",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/event/{id}/request"
      }
    ]
  },
  {
    "type": "get",
    "url": "/v1/event/sort/{field}/{order}",
    "title": "Сортировка списка мероприятий",
    "description": "<p>Для сортировки списка мероприятий нажно передать {field} - Поле мероприятия в URL по которому будет сортировка, и {order} - порядок сортировки. Возможные значения: {field} - rating|date|createdon, {order} - desc|asc.</p>",
    "name": "Sort",
    "group": "Event",
    "version": "1.0.0",
    "permission": [
      {
        "name": "none"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-type",
            "description": "<p>MIME тип ресурса, например: application/json or application/xml.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Пример заголовка:",
          "content": "\"Content-type\": \"application/json\"",
          "type": "String"
        }
      ]
    },
    "filename": "./modules/v1/controllers/EventController.php",
    "groupTitle": "Event",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/event/sort/{field}/{order}"
      }
    ]
  },
  {
    "type": "get",
    "url": "/v1/event/{id}/subscription",
    "title": "Список подписок на мероприятие",
    "description": "<p>Для получения списка подписок мероприятия нажно передать {id} - ID мероприятия в URL</p>",
    "name": "Subscription",
    "group": "Event",
    "version": "1.0.0",
    "permission": [
      {
        "name": "administrator"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-type",
            "description": "<p>MIME тип ресурса, например: application/json or application/xml.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>token авторизации.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Пример заголовка:",
          "content": "\"Content-type\": \"application/json\"\n\"Authorization\": \"Bearer BJHTN8rL9PfemW3Ws5shZK90jYh-RZ3QOXXDD9M3lXPe-GDE1pOPaHfN_JTxQprV\"",
          "type": "String"
        }
      ]
    },
    "filename": "./modules/v1/controllers/EventController.php",
    "groupTitle": "Event",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/event/{id}/subscription"
      }
    ]
  },
  {
    "type": "put",
    "url": "/v1/event/{id}",
    "title": "Обновление мероприятия",
    "description": "<p>Для обновления мероприятия нажно передать {id} - ID мероприятия в URL</p>",
    "name": "Update",
    "group": "Event",
    "version": "1.0.0",
    "permission": [
      {
        "name": "administrator"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-type",
            "description": "<p>MIME тип ресурса, например: application/json or application/xml.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>token авторизации.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Пример заголовка:",
          "content": "\"Content-type\": \"application/json\"\n\"Authorization\": \"Bearer BJHTN8rL9PfemW3Ws5shZK90jYh-RZ3QOXXDD9M3lXPe-GDE1pOPaHfN_JTxQprV\"",
          "type": "String"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "organization_id",
            "description": "<p>ID организации</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "locality_id",
            "description": "<p>ID населенного пункта</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "category_id",
            "description": "<p>ID категории</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>Название мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "introtext",
            "description": "<p>Краткое описание мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "description",
            "description": "<p>Подробное описание мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "image",
            "description": "<p>URL картинки мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "gallery",
            "description": "<p>Список URL картинок мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "video",
            "description": "<p>URL видео мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "address",
            "description": "<p>Адрес места проведения мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "phone",
            "description": "<p>Контактный телефон ответсвенного мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "email",
            "description": "<p>Электронная почта ответсвенного мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "contact",
            "description": "<p>ФИО ответсвенного мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "published",
            "description": "<p>Статус публикации мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "Unixtime",
            "optional": false,
            "field": "date",
            "description": "<p>Дата начала мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "time",
            "description": "<p>Время начала мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "tags",
            "description": "<p>Теги мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "latitude",
            "description": "<p>Широта на карте места проведения мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "longitude",
            "description": "<p>Долгота на карте места проведения мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "json",
            "optional": true,
            "field": "form",
            "description": "<p>Форма заявки мероприятия</p>"
          }
        ]
      }
    },
    "filename": "./modules/v1/controllers/EventController.php",
    "groupTitle": "Event",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/event/{id}"
      }
    ]
  },
  {
    "type": "get",
    "url": "/v1/locality",
    "title": "Список населенных пунктов",
    "name": "Locality",
    "group": "Locality",
    "version": "1.0.0",
    "filename": "./modules/v1/controllers/LocalityController.php",
    "groupTitle": "Locality",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/locality"
      }
    ]
  },
  {
    "type": "get",
    "url": "/v1/region",
    "title": "Список регионов",
    "name": "Region",
    "group": "Region",
    "version": "1.0.0",
    "filename": "./modules/v1/controllers/RegionController.php",
    "groupTitle": "Region",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/region"
      }
    ]
  },
  {
    "type": "post",
    "url": "/v1/request",
    "title": "Создание заявки",
    "name": "Create",
    "group": "Request",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "event_id",
            "description": "<p>ID мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "Json",
            "optional": false,
            "field": "request",
            "description": "<p>Обьект заявки</p>"
          }
        ]
      }
    },
    "filename": "./modules/v1/controllers/RequestController.php",
    "groupTitle": "Request",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/request"
      }
    ]
  },
  {
    "type": "get",
    "url": "/v1/request",
    "title": "Список заявок",
    "name": "Index",
    "group": "Request",
    "version": "1.0.0",
    "filename": "./modules/v1/controllers/RequestController.php",
    "groupTitle": "Request",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/request"
      }
    ]
  },
  {
    "type": "post",
    "url": "/v1/request/{id}",
    "title": "Обновление статуса заявки",
    "name": "Update",
    "group": "Request",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "status_id",
            "description": "<p>ID статуса</p>"
          }
        ]
      }
    },
    "filename": "./modules/v1/controllers/RequestController.php",
    "groupTitle": "Request",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/request/{id}"
      }
    ]
  },
  {
    "type": "post",
    "url": "/v1/status",
    "title": "Создание статуса заявки",
    "name": "Create",
    "group": "Status",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Название статуса</p>"
          }
        ]
      }
    },
    "filename": "./modules/v1/controllers/StatusController.php",
    "groupTitle": "Status",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/status"
      }
    ]
  },
  {
    "type": "get",
    "url": "/v1/status",
    "title": "Список статусов заявок",
    "name": "Status",
    "group": "Status",
    "version": "1.0.0",
    "filename": "./modules/v1/controllers/StatusController.php",
    "groupTitle": "Status",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/status"
      }
    ]
  },
  {
    "type": "post",
    "url": "/v1/status/{id}",
    "title": "Обновление статуса заявки",
    "name": "Update",
    "group": "Status",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Название статуса</p>"
          }
        ]
      }
    },
    "filename": "./modules/v1/controllers/StatusController.php",
    "groupTitle": "Status",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/status/{id}"
      }
    ]
  },
  {
    "type": "get",
    "url": "/v1/status/{id}",
    "title": "Статус заявки",
    "name": "View",
    "group": "Status",
    "version": "1.0.0",
    "filename": "./modules/v1/controllers/StatusController.php",
    "groupTitle": "Status",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/status/{id}"
      }
    ]
  },
  {
    "type": "post",
    "url": "/v1/subscription",
    "title": "Создание подписки",
    "name": "Create",
    "group": "Subscription",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "event_id",
            "description": "<p>ID мероприятия</p>"
          }
        ]
      }
    },
    "filename": "./modules/v1/controllers/SubscriptionController.php",
    "groupTitle": "Subscription",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/subscription"
      }
    ]
  },
  {
    "type": "get",
    "url": "/v1/subscription",
    "title": "Список подписок",
    "name": "Index",
    "group": "Subscription",
    "version": "1.0.0",
    "filename": "./modules/v1/controllers/SubscriptionController.php",
    "groupTitle": "Subscription",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/subscription"
      }
    ]
  },
  {
    "type": "post",
    "url": "/v1/user/access",
    "title": "Доступ к организации",
    "name": "Access",
    "group": "User",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "organization",
            "description": "<p>ID организации</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Номер телефона</p>"
          }
        ]
      }
    },
    "filename": "./modules/v1/controllers/UserController.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/user/access"
      }
    ]
  },
  {
    "type": "post",
    "url": "/v1/user/login",
    "title": "Авторизация",
    "name": "Login",
    "group": "User",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Номер телефона</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Пароль</p>"
          }
        ]
      }
    },
    "filename": "./modules/v1/controllers/UserController.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/user/login"
      }
    ]
  },
  {
    "type": "post",
    "url": "/v1/user/registration",
    "title": "Регистрация",
    "name": "Registration",
    "group": "User",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "fullname",
            "description": "<p>Ф.И.О.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Номер телефона</p>"
          }
        ]
      }
    },
    "filename": "./modules/v1/controllers/UserController.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/user/registration"
      }
    ]
  },
  {
    "type": "get",
    "url": "/v1/user",
    "title": "Список пользователей",
    "name": "user",
    "group": "User",
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Токен авторизации, Формат значения: Bearer {token}</p>"
          }
        ]
      }
    },
    "filename": "./modules/v1/controllers/UserController.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/user"
      }
    ]
  }
] });
