/**
 * js редактирования пользователей
 */
$(document).ready(function () {
    var self;

    /**
     * jquery элементы
     */
    self = {
        jqe: {
            // кнопка модального окна редактирования пользователя
            userEditModalWindowButton: $('.js-user-edit-button'),

            // кнопка редактирования пользователя
            userEditButton: $('.js-user-edit'),

            // модальное окно
            modalWindowWrapper: $('.js-modal-window-wrapper'),

            // форма редактирования пользователя
            userEditForm: $('#user-edit-form'),

            // таблица со списком пользователей
            userListTable: $('.js-user-list-table'),

            // поля формы
            login: $('#usereditform-login'),
            email: $('#usereditform-email'),
            id: $('#usereditform-id'),
            role: $('#usereditform-role'),
            activated: $('#usereditform-activated')
        },

        /**
         * инициализировать
         */
        init: function () {
            // заполнить данные пользователя для редактирования
            self.jqe.userEditModalWindowButton.on('click', function () {
                var userManageUrl = $(this).data('user-edit-url');

                // изменить action формы для редактирования указанного пользователя
                self.jqe.userEditForm.attr('action', userManageUrl);

                // получить и заполнить данные указанного пользователя для редактирования
                $.ajax({
                    url: userManageUrl,
                    success: function (data) {
                        self.fillEditForm(data);

                        self.jqe.userEditButton.attr('data-user-edit-url', userManageUrl);
                        self.jqe.userEditButton.attr('data-user-id', data.id);

                        // навесить событие на кнопку редактирования пользователя
                        self.jqe.userEditButton.unbind();
                        self.userEditDataEvent();
                    }
                });

                // отобразить модальное окно
                self.jqe.modalWindowWrapper.toggle();
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
         * навесить событие на кнопку изменения
         */
        userEditDataEvent: function () {
            // проверить данные пользователя при их изменении
            self.jqe.userEditButton.on('click', function () {
                self.jqe.userEditForm.yiiActiveForm('validateAttribute', 'usereditform-login');
                self.jqe.userEditForm.yiiActiveForm('validateAttribute', 'usereditform-password');
                self.jqe.userEditForm.yiiActiveForm('validateAttribute', 'usereditform-activated');
                self.jqe.userEditForm.yiiActiveForm('validateAttribute', 'usereditform-role');


                setTimeout(function () {
                    self.updateUserData()
                }, 500);
            });
        },

        /**
         * обновить данные пользователя на странице
         */
        updateUserData: function () {
            var activated,
                url = self.jqe.userEditButton.data('user-edit-url'),
                tr = self.jqe.userListTable.find('td.js-user-id[data-user-id="' + self.jqe.id.val() + '"]').parent();

            // таймаут для валидации и изменении данных пользователя
            $.ajax({
                    url: url,
                    success: function (data) {
                        tr.find('.js-user-login').html(data.login);
                        tr.find('.js-user-email').html(data.email);
                        tr.find('.js-user-role').html(data.role);

                        activated = data.activated ? 'активирован' : 'не активирован';
                        tr.find('.js-user-activated').html(activated);
                    }
                }
            );

        },

        /**
         * заполнить редактируемую форму данными пользователя
         */
        fillEditForm: function (data) {
            self.jqe.id.val(data.id);
            self.jqe.login.val(data.login);
            self.jqe.email.val(data.email);
            self.jqe.role.val(data.role);
            data.activated ? self.jqe.activated.prop('checked', 'true') : self.jqe.activated.removeAttr('checked');
        }
    };

    return self.init();
});
