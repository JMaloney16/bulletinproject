require('./bootstrap');

Echo.private('commentNotification')
  .listen('CommentPosted', (e) => {
    this.messages.push({
      message: e.message.comment,
      user: e.user
    });
  });