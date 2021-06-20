<dl>
    <dt>
        <label for="content">投稿本文</label>
    </dt>
    <dd>
        <textarea name="content" id="content" rows="8">{{ $article->content ?? old('content') }}</textarea>
    </dd>
    <dt>
        <label for="tags">タグ(最大5個)</label>
    </dt>
    <dd>
        <article-tags-input
         :initial-tags='@json($tagNames ?? [])'
         :autocomplete-items='@json($allTagNames ?? [])'
        >
        </article-tags-input>
    </dd>
</dl>