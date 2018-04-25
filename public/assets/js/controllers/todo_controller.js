Todos.TodoController = Ember.ObjectController.extend({
  actions: {
    editTodo: function() {
      this.set('isEditing', true);
    },
    acceptChanges: function() {
      this.set('isEditing', false);

      if (Ember.isEmpty(this.get('model.title'))) {
        this.send('removeTodo');
      } else {
        this.get('model').save();

        $.ajax({
          url: '/todo/'+this.get('model.id'),    
          type: 'PUT',
          data: {
            title: this.get('model.title'),
            isCompleted: this.get('model.isCompleted')
          },    
          success: function () {
          }
        });
      }
    },
    removeTodo: function () {
      var todo = this.get('model');
      $.ajax({
        url: '/todo/' + this.model.id,    
        type: 'DELETE',      
        success: function () {
        }
      });
      todo.deleteRecord();
      todo.save();
    },
  },
  isEditing: false,
  
  isCompleted: function(key, value){
    var model = this.get('model');
    if (value === undefined) {
      return model.get('isCompleted');
    } else {
      $.ajax({
        url: '/todo/'+model.get('id'),    
        type: 'PUT',
        data: {
          title: model.get('title'),
          isCompleted: !model.get('isCompleted')
        },    
        success: function () {
        }
      });
      model.set('isCompleted', value);
      model.save();
      return value;
    }
  }.property('model.isCompleted')

});
