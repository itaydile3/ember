Todos.Todo = DS.Model.extend({
  title: DS.attr('string'),
  isCompleted: DS.attr('boolean')
});

var todosJson = {};
jQuery.ajax({
  url: "/todo",
  cache: false,
  type: 'GET',
  dataType: "json",
  async: false,
  success: function(data) {
    todosJson = data;
  }
});

Todos.Todo.FIXTURES = todosJson;
