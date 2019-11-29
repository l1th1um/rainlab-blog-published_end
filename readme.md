# Published End at Blog

This plugin extend Rainlab Blog Plugin to also specifying date when blog stop to publish.

![](screenshot.png)

To filter only showing blog that not reaching the published_end date, extend the *blogPosts* component and add filter like this

```twig
    {% for post in posts %}
    {% if post.published_end_at is not null and date() <= date(post.published_end_at) %}
```