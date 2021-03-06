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
        "name": "administrator, manager"
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
            "description": "<p>MIME тип ресурса.</p>"
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
            "description": "<p>Краткое название мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "longtitle",
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
            "type": "Integer",
            "optional": true,
            "field": "formtype",
            "description": "<p>Тип формы заявки. Значения: 1 - Обычная форма заявки; 2 - Кнопка &quot;Я иду&quot;; 3 - Без формы заявки;</p>"
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
    "description": "<p>{id} - ID мероприятия в URL</p>",
    "name": "Delete",
    "group": "Event",
    "version": "1.0.0",
    "permission": [
      {
        "name": "administrator, manager"
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
            "description": "<p>MIME тип ресурса.</p>"
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
    "url": "/v1/event",
    "title": "Получение списка мероприятий",
    "name": "Event",
    "group": "Event",
    "version": "1.0.0",
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
        "url": "https://api.wetime.ru/v1/event"
      }
    ]
  },
  {
    "type": "get",
    "url": "/v1/event/filter/{field}/{id}",
    "title": "Фильтрация списка мероприятий",
    "description": "<p>{field} - поле фильтрации, возможные значения: organization, locality, category. {id} - ID обьекта фильтрации</p>",
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
        "url": "https://api.wetime.ru/v1/event/filter/{field}/{id}"
      }
    ]
  },
  {
    "type": "get",
    "url": "/v1/event/{id}/post",
    "title": "Список публикаций мероприятия",
    "description": "<p>{id} - ID мероприятия в URL</p>",
    "name": "Post",
    "group": "Event",
    "version": "1.0.0",
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
        "url": "https://api.wetime.ru/v1/event/{id}/post"
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
        "name": "administrator, manager"
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
            "description": "<p>MIME тип ресурса.</p>"
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
    "description": "<p>{field} - Поле мероприятия в URL по которому будет сортировка. {order} - порядок сортировки. Возможные значения: {field} - rating, date, createdon, {order} - desc, asc.</p>",
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
            "allowedValues": [
              "application/json",
              "application/xml"
            ],
            "optional": false,
            "field": "Content-type",
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
        "name": "administrator, manager"
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
            "description": "<p>MIME тип ресурса.</p>"
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
        "name": "administrator, manager"
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
            "description": "<p>MIME тип ресурса.</p>"
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
            "description": "<p>Краткое название мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "longtitle",
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
            "type": "Integer",
            "optional": true,
            "field": "formtype",
            "description": "<p>Тип формы заявки. Значения: 1 - Обычная форма заявки; 2 - Кнопка &quot;Я иду&quot;; 3 - Без формы заявки;</p>"
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
    "type": "post",
    "url": "/v1/organization",
    "title": "Создание организации",
    "name": "Create",
    "group": "Organization",
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
            "allowedValues": [
              "application/json",
              "application/xml"
            ],
            "optional": false,
            "field": "Content-type",
            "description": "<p>MIME тип ресурса.</p>"
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
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Название организации</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "longname",
            "description": "<p>Полное название организации</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "introtext",
            "description": "<p>Краткое описание организации</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Полное описание организации</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "image",
            "description": "<p>URL логотипа организации</p>"
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
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>Адрес организации</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Номер телефона организации</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Электронная почта организации</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "latitude",
            "description": "<p>Широта на карте места организации</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "longitude",
            "description": "<p>Долгота на карте места организации</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "published",
            "description": "<p>Статус публикации организации</p>"
          }
        ]
      }
    },
    "filename": "./modules/v1/controllers/OrganizationController.php",
    "groupTitle": "Organization",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/organization"
      }
    ]
  },
  {
    "type": "delete",
    "url": "/v1/organization/{id}",
    "title": "Удаление организации",
    "description": "<p>{id} - ID организации</p>",
    "name": "Delete",
    "group": "Organization",
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
            "allowedValues": [
              "application/json",
              "application/xml"
            ],
            "optional": false,
            "field": "Content-type",
            "description": "<p>MIME тип ресурса.</p>"
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
    "filename": "./modules/v1/controllers/OrganizationController.php",
    "groupTitle": "Organization",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/organization/{id}"
      }
    ]
  },
  {
    "type": "get",
    "url": "/v1/organization/{id}/event",
    "title": "Список мероприятий организации",
    "description": "<p>{id} - ID организации в URL</p>",
    "name": "Event",
    "group": "Organization",
    "version": "1.0.0",
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
    "filename": "./modules/v1/controllers/OrganizationController.php",
    "groupTitle": "Organization",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/organization/{id}/event"
      }
    ]
  },
  {
    "type": "get",
    "url": "/v1/organization",
    "title": "Получение списка организация",
    "name": "Organization",
    "group": "Organization",
    "version": "1.0.0",
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
    "filename": "./modules/v1/controllers/OrganizationController.php",
    "groupTitle": "Organization",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/organization"
      }
    ]
  },
  {
    "type": "put",
    "url": "/v1/organization/{id}",
    "title": "Обновление организации",
    "description": "<p>{id} - ID организации</p>",
    "name": "Update",
    "group": "Organization",
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
            "allowedValues": [
              "application/json",
              "application/xml"
            ],
            "optional": false,
            "field": "Content-type",
            "description": "<p>MIME тип ресурса.</p>"
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
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Название организации</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "longname",
            "description": "<p>Полное название организации</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "introtext",
            "description": "<p>Краткое описание организации</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Полное описание организации</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "image",
            "description": "<p>URL логотипа организации</p>"
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
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>Адрес организации</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Номер телефона организации</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Электронная почта организации</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "latitude",
            "description": "<p>Широта на карте места организации</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "longitude",
            "description": "<p>Долгота на карте места организации</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "published",
            "description": "<p>Статус публикации организации</p>"
          }
        ]
      }
    },
    "filename": "./modules/v1/controllers/OrganizationController.php",
    "groupTitle": "Organization",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/organization/{id}"
      }
    ]
  },
  {
    "type": "post",
    "url": "/v1/post",
    "title": "Создание публикации",
    "name": "Create",
    "group": "Post",
    "version": "1.0.0",
    "permission": [
      {
        "name": "administrator, manager"
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
            "description": "<p>MIME тип ресурса.</p>"
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
            "field": "event_id",
            "description": "<p>ID мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>Название публикации</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>Текст публикации</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "images",
            "description": "<p>URL картинки публикации</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "video",
            "description": "<p>URL видео публикации</p>"
          }
        ]
      }
    },
    "filename": "./modules/v1/controllers/PostController.php",
    "groupTitle": "Post",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/post"
      }
    ]
  },
  {
    "type": "delete",
    "url": "/v1/post/{id}",
    "title": "Удаление публикации",
    "description": "<p>{id} - ID публикации в URL</p>",
    "name": "Delete",
    "group": "Post",
    "version": "1.0.0",
    "permission": [
      {
        "name": "administrator, manager"
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
            "description": "<p>MIME тип ресурса.</p>"
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
    "filename": "./modules/v1/controllers/PostController.php",
    "groupTitle": "Post",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/post/{id}"
      }
    ]
  },
  {
    "type": "get",
    "url": "/v1/post",
    "title": "Список публикаций по подпискам",
    "name": "Post",
    "group": "Post",
    "version": "1.0.0",
    "permission": [
      {
        "name": "administrator, manager, user"
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
            "description": "<p>MIME тип ресурса.</p>"
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
    "filename": "./modules/v1/controllers/PostController.php",
    "groupTitle": "Post",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/post"
      }
    ]
  },
  {
    "type": "put",
    "url": "/v1/post",
    "title": "Обновление публикации",
    "name": "Update",
    "group": "Post",
    "version": "1.0.0",
    "permission": [
      {
        "name": "administrator, manager"
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
            "description": "<p>MIME тип ресурса.</p>"
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
            "field": "event_id",
            "description": "<p>ID мероприятия</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>Название публикации</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>Текст публикации</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "images",
            "description": "<p>URL картинки публикации</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "video",
            "description": "<p>URL видео публикации</p>"
          }
        ]
      }
    },
    "filename": "./modules/v1/controllers/PostController.php",
    "groupTitle": "Post",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/post"
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
            "description": "<p>MIME тип ресурса.</p>"
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
    "type": "delete",
    "url": "/v1/request/{id}",
    "title": "Удаление заявки",
    "description": "<p>{id} - ID заявки</p>",
    "name": "Delete",
    "group": "Request",
    "version": "1.0.0",
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
            "description": "<p>MIME тип ресурса.</p>"
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
    "filename": "./modules/v1/controllers/RequestController.php",
    "groupTitle": "Request",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/request/{id}"
      }
    ]
  },
  {
    "type": "get",
    "url": "/v1/request",
    "title": "Список заявок",
    "name": "Request",
    "group": "Request",
    "version": "1.0.0",
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
            "description": "<p>MIME тип ресурса.</p>"
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
    "filename": "./modules/v1/controllers/RequestController.php",
    "groupTitle": "Request",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/request"
      }
    ]
  },
  {
    "type": "put",
    "url": "/v1/request/{id}",
    "title": "Обновление статуса заявки",
    "description": "<p>{id} - ID заявки</p>",
    "name": "Update",
    "group": "Request",
    "version": "1.0.0",
    "permission": [
      {
        "name": "administrator, manager"
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
            "description": "<p>MIME тип ресурса.</p>"
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
    "permission": [
      {
        "name": "administrator, manager"
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
            "description": "<p>MIME тип ресурса.</p>"
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
    "type": "delete",
    "url": "/v1/status/{id}",
    "title": "Удаление статуса",
    "description": "<p>{id} - ID статуса</p>",
    "name": "Delete",
    "group": "Status",
    "version": "1.0.0",
    "permission": [
      {
        "name": "administrator, manager"
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
            "description": "<p>MIME тип ресурса.</p>"
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
    "url": "/v1/status",
    "title": "Список статусов заявок",
    "name": "Status",
    "group": "Status",
    "version": "1.0.0",
    "permission": [
      {
        "name": "administrator, manager"
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
            "description": "<p>MIME тип ресурса.</p>"
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
    "filename": "./modules/v1/controllers/StatusController.php",
    "groupTitle": "Status",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/status"
      }
    ]
  },
  {
    "type": "put",
    "url": "/v1/status/{id}",
    "title": "Обновление статуса заявки",
    "name": "Update",
    "group": "Status",
    "version": "1.0.0",
    "permission": [
      {
        "name": "administrator, manager"
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
            "description": "<p>MIME тип ресурса.</p>"
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
    "permission": [
      {
        "name": "administrator, manager"
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
            "description": "<p>MIME тип ресурса.</p>"
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
            "description": "<p>MIME тип ресурса.</p>"
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
    "type": "delete",
    "url": "/v1/subscription/{id}",
    "title": "Удаление подписки",
    "description": "<p>{id} - ID подписки</p>",
    "name": "Delete",
    "group": "Subscription",
    "version": "1.0.0",
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
            "description": "<p>MIME тип ресурса.</p>"
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
    "filename": "./modules/v1/controllers/SubscriptionController.php",
    "groupTitle": "Subscription",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/subscription/{id}"
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
            "description": "<p>MIME тип ресурса.</p>"
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
            "allowedValues": [
              "application/json",
              "application/xml"
            ],
            "optional": false,
            "field": "Content-type",
            "description": "<p>MIME тип ресурса.</p>"
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
    "permission": [
      {
        "name": "root"
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
            "description": "<p>MIME тип ресурса.</p>"
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
    "filename": "./modules/v1/controllers/UserController.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "https://api.wetime.ru/v1/user"
      }
    ]
  }
] });
