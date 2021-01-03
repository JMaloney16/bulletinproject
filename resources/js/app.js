require('./bootstrap');

Echo.private('commentNotification')
  .listen('CommentPosted', (e) => {
    // this.messages.push({
    //   comment: e.comment.comment,
    //   user: e.user
    // });
    console.log(e)
  });