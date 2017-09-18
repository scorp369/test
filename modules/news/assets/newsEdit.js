/**
 * js редактирования новостей
 */
$(document).ready(function () {
    var self;

    /**
     * jquery элементы
     */
    self = {
        jqe: {
            // кнопка модального окна редактирования новостей
            newsEditModalWindowButton: $('.js-news-edit-modal-window-button'),

            // кнопка редактирования пользователя
            newsEditButton: $('.js-news-edit'),

            // модальное окно
            modalWindowWrapper: $('.js-modal-window-wrapper'),

            // форма редактирования пользователя
            newsEditForm: $('#news-edit-form'),

            // кнопка изменения статуса пользователя
            newsChangeStateButton: $('.js-news-change-state'),

            // поля формы
            id: $('#newseditform-id'),
            name: $('#newseditform-name'),
            description: $('#newseditform-description'),
            state: $('#newseditform-state')
        },

        /**
         * инициализировать
         */
        init: function () {
            // заполнить данные пользователя для редактирования
            self.jqe.newsEditModalWindowButton.on('click', function () {
                var newsManageUrl = $(this).data('news-edit-url');

                // изменить action формы для редактирования новости
                self.jqe.newsEditForm.attr('action', newsManageUrl);

                // получить и заполнить данные указанного пользователя для редактирования
                $.ajax({
                    url: newsManageUrl,
                    success: function (data) {
                        self.fillEditForm(data);
                    }
                });

                // отобразить модальное окно
                self.jqe.modalWindowWrapper.toggle();
            });

            self.jqe.newsChangeStateButton.on('click', function () {
                var url = $(this).data('news-change-state-url'),
                    changeStateButton = $(this);

                $.ajax({
                    url: url,
                    success: function (data) {
                        console.log(data, changeStateButton.html());
                        if (data) {
                            changeStateButton.html('активен');
                        } else {
                            changeStateButton.html('не активен');
                        }
                    }
                })
            });

            // переключить видимость модального окна при нажатии на его wrapper
            self.jqe.modalWindowWrapper.on('click', function () {
                $(this).toggle();
            });

            // отменить всплытие событий при нажатии на модальное окно
            self.jqe.modalWindowWrapper.children().on('click', function (e) {
                e.stopPropagation();
            });
        },

        /**
         * заполнить редактируемую форму данными пользователя
         */
        fillEditForm: function (data) {
            self.jqe.id.val(data.id);
            self.jqe.name.val(data.name);
            self.jqe.description.val(data.description);
            data.state ? self.jqe.state.prop('checked', 'true') : self.jqe.state.removeAttr('checked');
        }
    };

    return self.init();
});
