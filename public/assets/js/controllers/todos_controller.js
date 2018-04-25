Todos.TodosController = Ember.ArrayController.extend({
  actions: {
    createTodo: function() {
      // Get the todo title set by the "New Todo" text field
      var title = this.get('newTitle');
      if (!title.trim()) { return; }

      var newId = '';
      $.ajax({
        url: "/todo",
        cache: false,
        type: 'POST',
        dataType: "json",
        data: {
          title: title,
          isCompleted: false
        }, 
        async: false,
        success: function(data) {
          newId = data.id;
        }
      });

      // Create the new Todo model
      var todo = this.store.createRecord('todo', {
        id: newId,
        title: title,
        isCompleted: false
      });

      // Clear the "New Todo" text field
      this.set('newTitle', '');

      // Save the new model
      todo.save();
    },
    clearCompleted: function() {
      var completed = this.filterBy('isCompleted', true);
      completed.invoke('deleteRecord');
      completed.invoke('save');
    }
  },
  all: function() {
    return this.filterBy('id').get('length');
  }.property('@each.id'),

  remaining: function() {
    // console.log(this.filterBy('id').get('length'));
    return this.filterBy('isCompleted', false).get('length');
  }.property('@each.isCompleted'),
  // inflection: function() {
  //   var remaining = this.get('remaining');
  //   return remaining === 1 ? 'item' : 'items';
  // }.property('remaining'),
  hasCompleted: function() {
    return this.get('completed') > 0;
  }.property('completed'),
  completed: function() {
    return this.filterBy('isCompleted', true).get('length');
  }.property('@each.isCompleted'),
  allAreDone: function(key, value) {
    if (value === undefined) {
      return !!this.get('length') && this.everyProperty('isCompleted', true);
    } else {
      this.setEach('isCompleted', value);
      this.invoke('save');
      $.ajax({
          url: '/todo/updateAll',    
          type: 'POST',
          data: {
            isCompleted: value
          },    
          success: function () {
          }
        });
      return value;
    }
  }.property('@each.isCompleted')
});