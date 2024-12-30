<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Wassup Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('/vendor/scribe/css/theme-default.style.css') }}" media="screen" />
    <link rel="stylesheet" href="{{ asset('/vendor/scribe/css/theme-default.print.css') }}" media="print" />

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css" />
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
      /* starts out as display none and is replaced with js later  */
      body .content .bash-example code {
        display: none;
      }
      body .content .javascript-example code {
        display: none;
      }
    </style>

    <script src="{{ asset('/vendor/scribe/js/theme-default-4.38.0.js') }}"></script>
  </head>

  <body data-languages='["bash","javascript"]'>
    <a href="#" id="nav-button">
      <span>
        MENU
        <img src="{{ asset('/vendor/scribe/images/navbar.png') }}" alt="navbar-image" />
      </span>
    </a>
    <div class="tocify-wrapper">
      <div class="lang-selector">
        <button type="button" class="lang-button" data-language-name="bash">bash</button>
        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
      </div>

      <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search" />
      </div>

      <div id="toc">
        <ul id="tocify-header-introduction" class="tocify-header">
          <li class="tocify-item level-1" data-unique="introduction">
            <a href="#introduction">Introduction</a>
          </li>
        </ul>
        <ul id="tocify-header-authenticating-requests" class="tocify-header">
          <li class="tocify-item level-1" data-unique="authenticating-requests">
            <a href="#authenticating-requests">Authenticating requests</a>
          </li>
        </ul>
        <ul id="tocify-header-organizations" class="tocify-header">
          <li class="tocify-item level-1" data-unique="organizations">
            <a href="#organizations">Organizations</a>
          </li>
          <ul id="tocify-subheader-organizations" class="tocify-subheader">
            <li class="tocify-item level-2" data-unique="organizations-GETapi-organizations">
              <a href="#organizations-GETapi-organizations">List all organizations.</a>
            </li>
            <li class="tocify-item level-2" data-unique="organizations-GETapi-organizations--organization-">
              <a href="#organizations-GETapi-organizations--organization-">Retrieve an organization.</a>
            </li>
            <li class="tocify-item level-2" data-unique="organizations-POSTapi-organizations">
              <a href="#organizations-POSTapi-organizations">Create an organization.</a>
            </li>
            <li class="tocify-item level-2" data-unique="organizations-PUTapi-organizations--organization-">
              <a href="#organizations-PUTapi-organizations--organization-">Update an organization.</a>
            </li>
            <li class="tocify-item level-2" data-unique="organizations-DELETEapi-organizations--organization-">
              <a href="#organizations-DELETEapi-organizations--organization-">Delete an organization.</a>
            </li>
            <li class="tocify-item level-2" data-unique="organizations-cycles">
              <a href="#organizations-cycles">Cycles</a>
            </li>
            <ul id="tocify-subheader-organizations-cycles" class="tocify-subheader">
              <li class="tocify-item level-3" data-unique="organizations-GETapi-organizations--organization--cycles">
                <a href="#organizations-GETapi-organizations--organization--cycles">List all cycles.</a>
              </li>
              <li class="tocify-item level-3" data-unique="organizations-GETapi-organizations--organization--cycles-active">
                <a href="#organizations-GETapi-organizations--organization--cycles-active">Retrieve the current active cycle.</a>
              </li>
              <li class="tocify-item level-3" data-unique="organizations-POSTapi-organizations--organization--cycles">
                <a href="#organizations-POSTapi-organizations--organization--cycles">Create a cycle.</a>
              </li>
              <li class="tocify-item level-3" data-unique="organizations-GETapi-organizations--organization--cycles--cycle-">
                <a href="#organizations-GETapi-organizations--organization--cycles--cycle-">Retrieve a cycle.</a>
              </li>
              <li class="tocify-item level-3" data-unique="organizations-PUTapi-organizations--organization--cycles--cycle-">
                <a href="#organizations-PUTapi-organizations--organization--cycles--cycle-">Update a cycle.</a>
              </li>
              <li class="tocify-item level-3" data-unique="organizations-DELETEapi-organizations--organization--cycles--cycle-">
                <a href="#organizations-DELETEapi-organizations--organization--cycles--cycle-">Delete a cycle.</a>
              </li>
            </ul>
          </ul>
        </ul>
        <ul id="tocify-header-profile" class="tocify-header">
          <li class="tocify-item level-1" data-unique="profile">
            <a href="#profile">Profile</a>
          </li>
          <ul id="tocify-subheader-profile" class="tocify-subheader">
            <li class="tocify-item level-2" data-unique="profile-GETapi-me">
              <a href="#profile-GETapi-me">Get the information about the logged user.</a>
            </li>
          </ul>
        </ul>
      </div>

      <ul class="toc-footer" id="toc-footer">
        <li style="padding-bottom: 5px"><a href="{{ route('scribe.postman') }}">View Postman collection</a></li>
        <li style="padding-bottom: 5px"><a href="{{ route('scribe.openapi') }}">View OpenAPI spec</a></li>
        <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
      </ul>

      <ul class="toc-footer" id="last-updated">
        <li>Last updated: December 27, 2024</li>
      </ul>
    </div>

    <div class="page-wrapper">
      <div class="dark-box"></div>
      <div class="content">
        <h1 id="introduction">Introduction</h1>
        <aside>
          <strong>Base URL</strong>
          :
          <code>https://wassup.test</code>
        </aside>
        <p>This documentation aims to provide all the information you need to work with our API.</p>
        <aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile). You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).</aside>

        <h1 id="authenticating-requests">Authenticating requests</h1>
        <p>
          To authenticate requests, include an
          <strong><code>Authorization</code></strong>
          header with the value
          <strong><code>"Bearer {YOUR_AUTH_KEY}"</code></strong>
          .
        </p>
        <p>
          All authenticated endpoints are marked with a
          <code>requires authentication</code>
          badge in the documentation below.
        </p>
        <p>
          You can retrieve your token by visiting your dashboard and clicking
          <b>Generate API token</b>
          .
        </p>

        <h1 id="organizations">Organizations</h1>

        <p>Organizations represent a company, or a group of people.</p>
        <p>Organizations are created by users. Any user, regardless of their role, can create an organization.</p>
        <p>Organizations are identified by a unique code. This code is used to let other users join the organization.</p>
        <p>Organizations also have a slug. This slug is used to identify the organization in the URL.</p>

        <h2 id="organizations-GETapi-organizations">List all organizations.</h2>

        <p></p>

        <p>This API call returns a paginated collection of organizations that contains 15 items per page.</p>

        <span id="example-requests-GETapi-organizations">
          <blockquote>Example request:</blockquote>

          <div class="bash-example">
            <pre><code class="language-bash">curl --request GET \
    --get "https://wassup.test/api/organizations" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
          </div>

          <div class="javascript-example">
            <pre><code class="language-javascript">const url = new URL(
    "https://wassup.test/api/organizations"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
          </div>
        </span>

        <span id="example-responses-GETapi-organizations">
          <blockquote>
            <p>Example response (200):</p>
          </blockquote>
          <pre>

<code class="language-json" style="max-height: 300px;">{&quot;data&quot;: [{
 &quot;id&quot;: 1,
 &quot;object&quot;: &quot;organization&quot;,
 &quot;name&quot;: &quot;Acme, Inc.&quot;,
 &quot;slug&quot;: &quot;acme-inc&quot;,
 &quot;code&quot;: &quot;ACME1234567890&quot;,
 &quot;created_at&quot;: 1514764800,
 &quot;updated_at&quot;: 1514764800,
}, {
 &quot;id&quot;: 2,
 &quot;object&quot;: &quot;organization&quot;,
 &quot;name&quot;: &quot;Acme, Inc.&quot;,
 &quot;slug&quot;: &quot;acme-inc&quot;,
 &quot;code&quot;: &quot;ACME1234567890&quot;,
 &quot;created_at&quot;: 1514764800,
 &quot;updated_at&quot;: 1514764800,
}],
&quot;links&quot;: {
  &quot;first&quot;: &quot;http://wassup.test/api/organizations?page=1&quot;,
  &quot;last&quot;: &quot;http://wassup.test/api/organizations?page=1&quot;,
  &quot;prev&quot;: null,
  &quot;next&quot;: null
 },
 &quot;meta&quot;: {
   &quot;current_page&quot;: 1,
   &quot;from&quot;: 1,
   &quot;last_page&quot;: 1,
   &quot;links&quot;: [
     {
       &quot;url&quot;: null,
       &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
       &quot;active&quot;: false
     },
     {
       &quot;url&quot;: &quot;http://wassup.test/api/organizations?page=1&quot;,
       &quot;label&quot;: &quot;1&quot;,
       &quot;active&quot;: true
     },
     {
       &quot;url&quot;: null,
       &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
       &quot;active&quot;: false
     }
   ],
   &quot;path&quot;: &quot;http://wassup.test/api/organizations&quot;,
   &quot;per_page&quot;: 15,
   &quot;to&quot;: 1,
   &quot;total&quot;: 1
 }</code>
 </pre>
        </span>
        <span id="execution-results-GETapi-organizations" hidden>
          <blockquote>
            Received response
            <span id="execution-response-status-GETapi-organizations"></span>
            :
          </blockquote>
          <pre class="json"><code id="execution-response-content-GETapi-organizations"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
        </span>
        <span id="execution-error-GETapi-organizations" hidden>
          <blockquote>Request failed with error:</blockquote>
          <pre><code id="execution-error-message-GETapi-organizations">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
        </span>
        <form id="form-GETapi-organizations" data-method="GET" data-path="api/organizations" data-authed="0" data-hasfiles="0" data-isarraybody="0" autocomplete="off" onsubmit="event.preventDefault(); executeTryOut('GETapi-organizations', this);">
          <h3>Request&nbsp;&nbsp;&nbsp;</h3>
          <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/organizations</code></b>
          </p>
          <h4 class="fancy-heading-panel"><b>Headers</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Content-Type</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Content-Type" data-endpoint="GETapi-organizations" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Accept</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Accept" data-endpoint="GETapi-organizations" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
        </form>

        <h3>Response</h3>
        <h4 class="fancy-heading-panel"><b>Response Fields</b></h4>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>id</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>Unique identifier for the object.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>object</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The object type. Always &quot;organization&quot;.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>name</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The name of the organization.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>slug</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The slug of the organization.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>code</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The code of the organization.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>created_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The date the object was created. Represented as a Unix timestamp.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>updated_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The date the object was last updated. Represented as a Unix timestamp.</p>
        </div>
        <h2 id="organizations-GETapi-organizations--organization-">Retrieve an organization.</h2>

        <p></p>

        <span id="example-requests-GETapi-organizations--organization-">
          <blockquote>Example request:</blockquote>

          <div class="bash-example">
            <pre><code class="language-bash">curl --request GET \
    --get "https://wassup.test/api/organizations/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
          </div>

          <div class="javascript-example">
            <pre><code class="language-javascript">const url = new URL(
    "https://wassup.test/api/organizations/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
          </div>
        </span>

        <span id="example-responses-GETapi-organizations--organization-">
          <blockquote>
            <p>Example response (200):</p>
          </blockquote>
          <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;object&quot;: &quot;organization&quot;,
    &quot;name&quot;: &quot;Acme, Inc.&quot;,
    &quot;slug&quot;: &quot;acme-inc&quot;,
    &quot;code&quot;: &quot;ACME1234567890&quot;,
    &quot;created_at&quot;: 1514764800,
    &quot;updated_at&quot;: 1514764800
}</code>
 </pre>
        </span>
        <span id="execution-results-GETapi-organizations--organization-" hidden>
          <blockquote>
            Received response
            <span id="execution-response-status-GETapi-organizations--organization-"></span>
            :
          </blockquote>
          <pre class="json"><code id="execution-response-content-GETapi-organizations--organization-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
        </span>
        <span id="execution-error-GETapi-organizations--organization-" hidden>
          <blockquote>Request failed with error:</blockquote>
          <pre><code id="execution-error-message-GETapi-organizations--organization-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
        </span>
        <form id="form-GETapi-organizations--organization-" data-method="GET" data-path="api/organizations/{organization}" data-authed="0" data-hasfiles="0" data-isarraybody="0" autocomplete="off" onsubmit="event.preventDefault(); executeTryOut('GETapi-organizations--organization-', this);">
          <h3>Request&nbsp;&nbsp;&nbsp;</h3>
          <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/organizations/{organization}</code></b>
          </p>
          <h4 class="fancy-heading-panel"><b>Headers</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Content-Type</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Content-Type" data-endpoint="GETapi-organizations--organization-" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Accept</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Accept" data-endpoint="GETapi-organizations--organization-" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
          <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>organization</code></b>
            &nbsp;&nbsp;
            <small>string</small>
            &nbsp; &nbsp;
            <input type="text" style="display: none" name="organization" data-endpoint="GETapi-organizations--organization-" value="1" data-component="url" />
            <br />
            <p>
              The id of the organization. Example:
              <code>1</code>
            </p>
          </div>
        </form>

        <h3>Response</h3>
        <h4 class="fancy-heading-panel"><b>Response Fields</b></h4>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>id</code></b>
          &nbsp;&nbsp;
          <small>integer</small>
          &nbsp; &nbsp;
          <br />
          <p>Unique identifier for the object.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>object</code></b>
          &nbsp;&nbsp;
          <small>string</small>
          &nbsp; &nbsp;
          <br />
          <p>The object type. Always &quot;organization&quot;.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>name</code></b>
          &nbsp;&nbsp;
          <small>string</small>
          &nbsp; &nbsp;
          <br />
          <p>The name of the organization.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>slug</code></b>
          &nbsp;&nbsp;
          <small>string</small>
          &nbsp; &nbsp;
          <br />
          <p>The slug of the organization.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>code</code></b>
          &nbsp;&nbsp;
          <small>string</small>
          &nbsp; &nbsp;
          <br />
          <p>The code of the organization.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>created_at</code></b>
          &nbsp;&nbsp;
          <small>integer</small>
          &nbsp; &nbsp;
          <br />
          <p>The date the object was created. Represented as a Unix timestamp.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>updated_at</code></b>
          &nbsp;&nbsp;
          <small>integer</small>
          &nbsp; &nbsp;
          <br />
          <p>The date the object was last updated. Represented as a Unix timestamp.</p>
        </div>
        <h2 id="organizations-POSTapi-organizations">Create an organization.</h2>

        <p></p>

        <span id="example-requests-POSTapi-organizations">
          <blockquote>Example request:</blockquote>

          <div class="bash-example">
            <pre><code class="language-bash">curl --request POST \
    "https://wassup.test/api/organizations" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Acme, Inc.\"
}"
</code></pre>
          </div>

          <div class="javascript-example">
            <pre><code class="language-javascript">const url = new URL(
    "https://wassup.test/api/organizations"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Acme, Inc."
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
          </div>
        </span>

        <span id="example-responses-POSTapi-organizations">
          <blockquote>
            <p>Example response (201):</p>
          </blockquote>
          <pre>

<code class="language-json" style="max-height: 300px;">{
 &quot;id&quot;: 1,
 &quot;object&quot;: &quot;organization&quot;,
 &quot;name&quot;: &quot;Acme, Inc.&quot;,
 &quot;slug&quot;: &quot;acme-inc&quot;,
 &quot;code&quot;: &quot;ACME1234567890&quot;,
 &quot;created_at&quot;: 1514764800,
 &quot;updated_at&quot;: 1514764800,
}</code>
 </pre>
        </span>
        <span id="execution-results-POSTapi-organizations" hidden>
          <blockquote>
            Received response
            <span id="execution-response-status-POSTapi-organizations"></span>
            :
          </blockquote>
          <pre class="json"><code id="execution-response-content-POSTapi-organizations"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
        </span>
        <span id="execution-error-POSTapi-organizations" hidden>
          <blockquote>Request failed with error:</blockquote>
          <pre><code id="execution-error-message-POSTapi-organizations">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
        </span>
        <form id="form-POSTapi-organizations" data-method="POST" data-path="api/organizations" data-authed="0" data-hasfiles="0" data-isarraybody="0" autocomplete="off" onsubmit="event.preventDefault(); executeTryOut('POSTapi-organizations', this);">
          <h3>Request&nbsp;&nbsp;&nbsp;</h3>
          <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/organizations</code></b>
          </p>
          <h4 class="fancy-heading-panel"><b>Headers</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Content-Type</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Content-Type" data-endpoint="POSTapi-organizations" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Accept</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Accept" data-endpoint="POSTapi-organizations" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
          <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>name</code></b>
            &nbsp;&nbsp;
            <small>string</small>
            &nbsp; &nbsp;
            <input type="text" style="display: none" name="name" data-endpoint="POSTapi-organizations" value="Acme, Inc." data-component="body" />
            <br />
            <p>
              The name of the organization. Max 255 characters. Example:
              <code>Acme, Inc.</code>
            </p>
          </div>
        </form>

        <h3>Response</h3>
        <h4 class="fancy-heading-panel"><b>Response Fields</b></h4>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>id</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>Unique identifier for the object.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>object</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The object type. Always &quot;organization&quot;.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>name</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The name of the organization.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>slug</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The slug of the organization.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>code</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The code of the organization.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>created_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The date the object was created. Represented as a Unix timestamp.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>updated_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The date the object was last updated. Represented as a Unix timestamp.</p>
        </div>
        <h2 id="organizations-PUTapi-organizations--organization-">Update an organization.</h2>

        <p></p>

        <p>Only administrators can update an organization. Changing the name of the organization will change the slug and therfore, all the URLs that were previously created for this organization will be invalidated.</p>

        <span id="example-requests-PUTapi-organizations--organization-">
          <blockquote>Example request:</blockquote>

          <div class="bash-example">
            <pre><code class="language-bash">curl --request PUT \
    "https://wassup.test/api/organizations/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Acme, Inc.\"
}"
</code></pre>
          </div>

          <div class="javascript-example">
            <pre><code class="language-javascript">const url = new URL(
    "https://wassup.test/api/organizations/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Acme, Inc."
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
          </div>
        </span>

        <span id="example-responses-PUTapi-organizations--organization-">
          <blockquote>
            <p>Example response (200):</p>
          </blockquote>
          <pre>

<code class="language-json" style="max-height: 300px;">{
 &quot;id&quot;: 1,
 &quot;object&quot;: &quot;organization&quot;,
 &quot;name&quot;: &quot;Acme, Inc.&quot;,
 &quot;slug&quot;: &quot;acme-inc&quot;,
 &quot;code&quot;: &quot;ACME1234567890&quot;,
 &quot;created_at&quot;: 1514764800,
 &quot;updated_at&quot;: 1514764800,
}</code>
 </pre>
        </span>
        <span id="execution-results-PUTapi-organizations--organization-" hidden>
          <blockquote>
            Received response
            <span id="execution-response-status-PUTapi-organizations--organization-"></span>
            :
          </blockquote>
          <pre class="json"><code id="execution-response-content-PUTapi-organizations--organization-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
        </span>
        <span id="execution-error-PUTapi-organizations--organization-" hidden>
          <blockquote>Request failed with error:</blockquote>
          <pre><code id="execution-error-message-PUTapi-organizations--organization-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
        </span>
        <form id="form-PUTapi-organizations--organization-" data-method="PUT" data-path="api/organizations/{organization}" data-authed="0" data-hasfiles="0" data-isarraybody="0" autocomplete="off" onsubmit="event.preventDefault(); executeTryOut('PUTapi-organizations--organization-', this);">
          <h3>Request&nbsp;&nbsp;&nbsp;</h3>
          <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/organizations/{organization}</code></b>
          </p>
          <h4 class="fancy-heading-panel"><b>Headers</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Content-Type</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Content-Type" data-endpoint="PUTapi-organizations--organization-" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Accept</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Accept" data-endpoint="PUTapi-organizations--organization-" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
          <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>organization</code></b>
            &nbsp;&nbsp;
            <small>string</small>
            &nbsp; &nbsp;
            <input type="text" style="display: none" name="organization" data-endpoint="PUTapi-organizations--organization-" value="1" data-component="url" />
            <br />
            <p>
              The id of the organization. Example:
              <code>1</code>
            </p>
          </div>
          <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>name</code></b>
            &nbsp;&nbsp;
            <small>string</small>
            &nbsp; &nbsp;
            <input type="text" style="display: none" name="name" data-endpoint="PUTapi-organizations--organization-" value="Acme, Inc." data-component="body" />
            <br />
            <p>
              The name of the organization. Max 255 characters. Example:
              <code>Acme, Inc.</code>
            </p>
          </div>
        </form>

        <h3>Response</h3>
        <h4 class="fancy-heading-panel"><b>Response Fields</b></h4>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>id</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>Unique identifier for the object.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>object</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The object type. Always &quot;organization&quot;.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>name</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The name of the organization.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>slug</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The slug of the organization.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>code</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The code of the organization.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>created_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The date the object was created. Represented as a Unix timestamp.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>updated_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The date the object was last updated. Represented as a Unix timestamp.</p>
        </div>
        <h2 id="organizations-DELETEapi-organizations--organization-">Delete an organization.</h2>

        <p></p>

        <p>Only administrators can delete an organization.</p>

        <span id="example-requests-DELETEapi-organizations--organization-">
          <blockquote>Example request:</blockquote>

          <div class="bash-example">
            <pre><code class="language-bash">curl --request DELETE \
    "https://wassup.test/api/organizations/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
          </div>

          <div class="javascript-example">
            <pre><code class="language-javascript">const url = new URL(
    "https://wassup.test/api/organizations/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre>
          </div>
        </span>

        <span id="example-responses-DELETEapi-organizations--organization-">
          <blockquote>
            <p>Example response (200):</p>
          </blockquote>
          <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;
}</code>
 </pre>
        </span>
        <span id="execution-results-DELETEapi-organizations--organization-" hidden>
          <blockquote>
            Received response
            <span id="execution-response-status-DELETEapi-organizations--organization-"></span>
            :
          </blockquote>
          <pre class="json"><code id="execution-response-content-DELETEapi-organizations--organization-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
        </span>
        <span id="execution-error-DELETEapi-organizations--organization-" hidden>
          <blockquote>Request failed with error:</blockquote>
          <pre><code id="execution-error-message-DELETEapi-organizations--organization-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
        </span>
        <form id="form-DELETEapi-organizations--organization-" data-method="DELETE" data-path="api/organizations/{organization}" data-authed="0" data-hasfiles="0" data-isarraybody="0" autocomplete="off" onsubmit="event.preventDefault(); executeTryOut('DELETEapi-organizations--organization-', this);">
          <h3>Request&nbsp;&nbsp;&nbsp;</h3>
          <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/organizations/{organization}</code></b>
          </p>
          <h4 class="fancy-heading-panel"><b>Headers</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Content-Type</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Content-Type" data-endpoint="DELETEapi-organizations--organization-" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Accept</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Accept" data-endpoint="DELETEapi-organizations--organization-" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
          <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>organization</code></b>
            &nbsp;&nbsp;
            <small>string</small>
            &nbsp; &nbsp;
            <input type="text" style="display: none" name="organization" data-endpoint="DELETEapi-organizations--organization-" value="1" data-component="url" />
            <br />
            <p>
              The id of the organization. Example:
              <code>1</code>
            </p>
          </div>
        </form>

        <h2 id="organizations-cycles">Cycles</h2>
        <h2 id="organizations-GETapi-organizations--organization--cycles">List all cycles.</h2>

        <p></p>

        <p>This API call returns a paginated collection of cycles that contains 15 items per page.</p>

        <span id="example-requests-GETapi-organizations--organization--cycles">
          <blockquote>Example request:</blockquote>

          <div class="bash-example">
            <pre><code class="language-bash">curl --request GET \
    --get "https://wassup.test/api/organizations/recusandae/cycles" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
          </div>

          <div class="javascript-example">
            <pre><code class="language-javascript">const url = new URL(
    "https://wassup.test/api/organizations/recusandae/cycles"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
          </div>
        </span>

        <span id="example-responses-GETapi-organizations--organization--cycles">
          <blockquote>
            <p>Example response (200):</p>
          </blockquote>
          <pre>

<code class="language-json" style="max-height: 300px;">{&quot;data&quot;: [{
 &quot;id&quot;: 1,
 &quot;object&quot;: &quot;cycle&quot;,
 &quot;number&quot;: 1,
 &quot;description&quot;: &quot;This is a description of the cycle.&quot;,
 &quot;started_at&quot;: 1514764800,
 &quot;ended_at&quot;: 1514764800,
 &quot;is_active&quot;: true,
 &quot;is_public&quot;: true,
 &quot;created_at&quot;: 1514764800,
 &quot;updated_at&quot;: 1514764800,
}, {
 &quot;id&quot;: 2,
 &quot;object&quot;: &quot;cycle&quot;,
 &quot;number&quot;: 2,
 &quot;description&quot;: &quot;This is a description of the cycle.&quot;,
 &quot;started_at&quot;: 1514764800,
 &quot;ended_at&quot;: 1514764800,
 &quot;is_active&quot;: true,
 &quot;is_public&quot;: true,
 &quot;created_at&quot;: 1514764800,
 &quot;updated_at&quot;: 1514764800,
}],
&quot;links&quot;: {
  &quot;first&quot;: &quot;http://wassup.test/api/organizations/1/cycles?page=1&quot;,
  &quot;last&quot;: &quot;http://wassup.test/api/organizations/1/cycles?page=1&quot;,
  &quot;prev&quot;: null,
  &quot;next&quot;: null
 },
 &quot;meta&quot;: {
   &quot;current_page&quot;: 1,
   &quot;from&quot;: 1,
   &quot;last_page&quot;: 1,
   &quot;links&quot;: [
     {
       &quot;url&quot;: null,
       &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
       &quot;active&quot;: false
     },
     {
       &quot;url&quot;: &quot;http://wassup.test/api/organizations/1/cycles?page=1&quot;,
       &quot;label&quot;: &quot;1&quot;,
       &quot;active&quot;: true
     },
     {
       &quot;url&quot;: null,
       &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
       &quot;active&quot;: false
     }
   ],
   &quot;path&quot;: &quot;http://wassup.test/api/organizations/1/cycles&quot;,
   &quot;per_page&quot;: 15,
   &quot;to&quot;: 1,
   &quot;total&quot;: 1
 }</code>
 </pre>
        </span>
        <span id="execution-results-GETapi-organizations--organization--cycles" hidden>
          <blockquote>
            Received response
            <span id="execution-response-status-GETapi-organizations--organization--cycles"></span>
            :
          </blockquote>
          <pre class="json"><code id="execution-response-content-GETapi-organizations--organization--cycles"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
        </span>
        <span id="execution-error-GETapi-organizations--organization--cycles" hidden>
          <blockquote>Request failed with error:</blockquote>
          <pre><code id="execution-error-message-GETapi-organizations--organization--cycles">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
        </span>
        <form id="form-GETapi-organizations--organization--cycles" data-method="GET" data-path="api/organizations/{organization}/cycles" data-authed="0" data-hasfiles="0" data-isarraybody="0" autocomplete="off" onsubmit="event.preventDefault(); executeTryOut('GETapi-organizations--organization--cycles', this);">
          <h3>Request&nbsp;&nbsp;&nbsp;</h3>
          <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/organizations/{organization}/cycles</code></b>
          </p>
          <h4 class="fancy-heading-panel"><b>Headers</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Content-Type</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Content-Type" data-endpoint="GETapi-organizations--organization--cycles" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Accept</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Accept" data-endpoint="GETapi-organizations--organization--cycles" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
          <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>organization</code></b>
            &nbsp;&nbsp;
            <small>string</small>
            &nbsp; &nbsp;
            <input type="text" style="display: none" name="organization" data-endpoint="GETapi-organizations--organization--cycles" value="recusandae" data-component="url" />
            <br />
            <p>
              The organization. Example:
              <code>recusandae</code>
            </p>
          </div>
        </form>

        <h3>Response</h3>
        <h4 class="fancy-heading-panel"><b>Response Fields</b></h4>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>id</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>Unique identifier for the object.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>object</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The object type. Always &quot;cycle&quot;.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>number</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The number of the cycle.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>description</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The description of the cycle.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>started_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The start date of the cycle. Represented as a Unix timestamp.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>ended_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The end date of the cycle. Represented as a Unix timestamp.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>is_active</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>Whether the cycle is active.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>is_public</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>Whether the cycle is public.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>created_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The date the object was created. Represented as a Unix timestamp.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>updated_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The date the object was last updated. Represented as a Unix timestamp.</p>
        </div>
        <h2 id="organizations-GETapi-organizations--organization--cycles-active">Retrieve the current active cycle.</h2>

        <p></p>

        <p>Retrieves the current active cycle for the organization, if there is one. If there is no active cycle, it will return an empty response.</p>

        <span id="example-requests-GETapi-organizations--organization--cycles-active">
          <blockquote>Example request:</blockquote>

          <div class="bash-example">
            <pre><code class="language-bash">curl --request GET \
    --get "https://wassup.test/api/organizations/1/cycles/active" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
          </div>

          <div class="javascript-example">
            <pre><code class="language-javascript">const url = new URL(
    "https://wassup.test/api/organizations/1/cycles/active"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
          </div>
        </span>

        <span id="example-responses-GETapi-organizations--organization--cycles-active">
          <blockquote>
            <p>Example response (200):</p>
          </blockquote>
          <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;id&quot;: 1,
  &quot;object&quot;: &quot;cycle&quot;,
  &quot;number&quot;: 1,
  &quot;description&quot;: &quot;This is a description of the cycle.&quot;,
  &quot;started_at&quot;: 1514764800,
  &quot;ended_at&quot;: 1514764800,
  &quot;is_active&quot;: true,
  &quot;is_public&quot;: true,
  &quot;created_at&quot;: 1514764800,
  &quot;updated_at&quot;: 1514764800,
}</code>
 </pre>
        </span>
        <span id="execution-results-GETapi-organizations--organization--cycles-active" hidden>
          <blockquote>
            Received response
            <span id="execution-response-status-GETapi-organizations--organization--cycles-active"></span>
            :
          </blockquote>
          <pre class="json"><code id="execution-response-content-GETapi-organizations--organization--cycles-active"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
        </span>
        <span id="execution-error-GETapi-organizations--organization--cycles-active" hidden>
          <blockquote>Request failed with error:</blockquote>
          <pre><code id="execution-error-message-GETapi-organizations--organization--cycles-active">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
        </span>
        <form id="form-GETapi-organizations--organization--cycles-active" data-method="GET" data-path="api/organizations/{organization}/cycles/active" data-authed="0" data-hasfiles="0" data-isarraybody="0" autocomplete="off" onsubmit="event.preventDefault(); executeTryOut('GETapi-organizations--organization--cycles-active', this);">
          <h3>Request&nbsp;&nbsp;&nbsp;</h3>
          <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/organizations/{organization}/cycles/active</code></b>
          </p>
          <h4 class="fancy-heading-panel"><b>Headers</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Content-Type</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Content-Type" data-endpoint="GETapi-organizations--organization--cycles-active" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Accept</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Accept" data-endpoint="GETapi-organizations--organization--cycles-active" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
          <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>organization</code></b>
            &nbsp;&nbsp;
            <small>string</small>
            &nbsp; &nbsp;
            <input type="text" style="display: none" name="organization" data-endpoint="GETapi-organizations--organization--cycles-active" value="1" data-component="url" />
            <br />
            <p>
              The id of the organization. Example:
              <code>1</code>
            </p>
          </div>
        </form>

        <h3>Response</h3>
        <h4 class="fancy-heading-panel"><b>Response Fields</b></h4>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>id</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>Unique identifier for the object.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>object</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The object type. Always &quot;cycle&quot;.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>number</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The number of the cycle.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>description</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The description of the cycle.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>started_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The start date of the cycle. Represented as a Unix timestamp.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>ended_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The end date of the cycle. Represented as a Unix timestamp.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>is_active</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>Whether the cycle is active.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>is_public</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>Whether the cycle is public.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>created_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The date the object was created. Represented as a Unix timestamp.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>updated_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The date the object was last updated. Represented as a Unix timestamp.</p>
        </div>
        <h2 id="organizations-POSTapi-organizations--organization--cycles">Create a cycle.</h2>

        <p></p>

        <p>Cycles represent a period of time in which people can set goals and check-in.</p>
        <p>Cycles are managed by administrators.</p>
        <p>Cycles can have a public URL. This URL is used to tell the world about the cycle.</p>

        <span id="example-requests-POSTapi-organizations--organization--cycles">
          <blockquote>Example request:</blockquote>

          <div class="bash-example">
            <pre><code class="language-bash">curl --request POST \
    "https://wassup.test/api/organizations/quaerat/cycles" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"number\": 1,
    \"description\": \"This is a description of the cycle.\",
    \"started_at\": \"2024-01-01\",
    \"ended_at\": \"2024-01-01\",
    \"is_active\": true,
    \"is_public\": true
}"
</code></pre>
          </div>

          <div class="javascript-example">
            <pre><code class="language-javascript">const url = new URL(
    "https://wassup.test/api/organizations/quaerat/cycles"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "number": 1,
    "description": "This is a description of the cycle.",
    "started_at": "2024-01-01",
    "ended_at": "2024-01-01",
    "is_active": true,
    "is_public": true
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
          </div>
        </span>

        <span id="example-responses-POSTapi-organizations--organization--cycles">
          <blockquote>
            <p>Example response (201):</p>
          </blockquote>
          <pre>

<code class="language-json" style="max-height: 300px;">{
 &quot;id&quot;: 1,
 &quot;object&quot;: &quot;cycle&quot;,
 &quot;number&quot;: 1,
 &quot;description&quot;: &quot;This is a description of the cycle.&quot;,
 &quot;started_at&quot;: 1514764800,
 &quot;ended_at&quot;: 1514764800,
 &quot;is_active&quot;: true,
 &quot;is_public&quot;: true,
 &quot;created_at&quot;: 1514764800,
 &quot;updated_at&quot;: 1514764800,
}</code>
 </pre>
        </span>
        <span id="execution-results-POSTapi-organizations--organization--cycles" hidden>
          <blockquote>
            Received response
            <span id="execution-response-status-POSTapi-organizations--organization--cycles"></span>
            :
          </blockquote>
          <pre class="json"><code id="execution-response-content-POSTapi-organizations--organization--cycles"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
        </span>
        <span id="execution-error-POSTapi-organizations--organization--cycles" hidden>
          <blockquote>Request failed with error:</blockquote>
          <pre><code id="execution-error-message-POSTapi-organizations--organization--cycles">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
        </span>
        <form id="form-POSTapi-organizations--organization--cycles" data-method="POST" data-path="api/organizations/{organization}/cycles" data-authed="0" data-hasfiles="0" data-isarraybody="0" autocomplete="off" onsubmit="event.preventDefault(); executeTryOut('POSTapi-organizations--organization--cycles', this);">
          <h3>Request&nbsp;&nbsp;&nbsp;</h3>
          <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/organizations/{organization}/cycles</code></b>
          </p>
          <h4 class="fancy-heading-panel"><b>Headers</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Content-Type</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Content-Type" data-endpoint="POSTapi-organizations--organization--cycles" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Accept</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Accept" data-endpoint="POSTapi-organizations--organization--cycles" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
          <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>organization</code></b>
            &nbsp;&nbsp;
            <small>string</small>
            &nbsp; &nbsp;
            <input type="text" style="display: none" name="organization" data-endpoint="POSTapi-organizations--organization--cycles" value="quaerat" data-component="url" />
            <br />
            <p>
              The organization. Example:
              <code>quaerat</code>
            </p>
          </div>
          <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>number</code></b>
            &nbsp;&nbsp;
            <small>integer</small>
            &nbsp; &nbsp;
            <input type="number" style="display: none" step="any" name="number" data-endpoint="POSTapi-organizations--organization--cycles" value="1" data-component="body" />
            <br />
            <p>
              The number of the cycle. Example:
              <code>1</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>description</code></b>
            &nbsp;&nbsp;
            <small>string</small>
            &nbsp; &nbsp;
            <input type="text" style="display: none" name="description" data-endpoint="POSTapi-organizations--organization--cycles" value="This is a description of the cycle." data-component="body" />
            <br />
            <p>
              The description of the cycle. Example:
              <code>This is a description of the cycle.</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>started_at</code></b>
            &nbsp;&nbsp;
            <small>string</small>
            &nbsp;
            <i>optional</i>
            &nbsp;
            <input type="text" style="display: none" name="started_at" data-endpoint="POSTapi-organizations--organization--cycles" value="2024-01-01" data-component="body" />
            <br />
            <p>
              The start date of the cycle, in ISO 8601 format (YYYY-MM-DD). Example:
              <code>2024-01-01</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>ended_at</code></b>
            &nbsp;&nbsp;
            <small>string</small>
            &nbsp;
            <i>optional</i>
            &nbsp;
            <input type="text" style="display: none" name="ended_at" data-endpoint="POSTapi-organizations--organization--cycles" value="2024-01-01" data-component="body" />
            <br />
            <p>
              The end date of the cycle, in ISO 8601 format (YYYY-MM-DD). Example:
              <code>2024-01-01</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>is_active</code></b>
            &nbsp;&nbsp;
            <small>boolean</small>
            &nbsp;
            <i>optional</i>
            &nbsp;
            <label data-endpoint="POSTapi-organizations--organization--cycles" style="display: none">
              <input type="radio" name="is_active" value="true" data-endpoint="POSTapi-organizations--organization--cycles" data-component="body" />
              <code>true</code>
            </label>
            <label data-endpoint="POSTapi-organizations--organization--cycles" style="display: none">
              <input type="radio" name="is_active" value="false" data-endpoint="POSTapi-organizations--organization--cycles" data-component="body" />
              <code>false</code>
            </label>
            <br />
            <p>
              Whether the cycle is active. Example:
              <code>true</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>is_public</code></b>
            &nbsp;&nbsp;
            <small>boolean</small>
            &nbsp;
            <i>optional</i>
            &nbsp;
            <label data-endpoint="POSTapi-organizations--organization--cycles" style="display: none">
              <input type="radio" name="is_public" value="true" data-endpoint="POSTapi-organizations--organization--cycles" data-component="body" />
              <code>true</code>
            </label>
            <label data-endpoint="POSTapi-organizations--organization--cycles" style="display: none">
              <input type="radio" name="is_public" value="false" data-endpoint="POSTapi-organizations--organization--cycles" data-component="body" />
              <code>false</code>
            </label>
            <br />
            <p>
              Whether the cycle is public. Example:
              <code>true</code>
            </p>
          </div>
        </form>

        <h3>Response</h3>
        <h4 class="fancy-heading-panel"><b>Response Fields</b></h4>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>id</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>Unique identifier for the object.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>object</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The object type. Always &quot;cycle&quot;.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>number</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The number of the cycle.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>description</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The description of the cycle.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>started_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The start date of the cycle. Represented as a Unix timestamp.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>ended_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The end date of the cycle. Represented as a Unix timestamp.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>is_active</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>Whether the cycle is active.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>is_public</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>Whether the cycle is public.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>created_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The date the object was created. Represented as a Unix timestamp.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>updated_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The date the object was last updated. Represented as a Unix timestamp.</p>
        </div>
        <h2 id="organizations-GETapi-organizations--organization--cycles--cycle-">Retrieve a cycle.</h2>

        <p></p>

        <span id="example-requests-GETapi-organizations--organization--cycles--cycle-">
          <blockquote>Example request:</blockquote>

          <div class="bash-example">
            <pre><code class="language-bash">curl --request GET \
    --get "https://wassup.test/api/organizations/1/cycles/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
          </div>

          <div class="javascript-example">
            <pre><code class="language-javascript">const url = new URL(
    "https://wassup.test/api/organizations/1/cycles/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
          </div>
        </span>

        <span id="example-responses-GETapi-organizations--organization--cycles--cycle-">
          <blockquote>
            <p>Example response (200):</p>
          </blockquote>
          <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;id&quot;: 1,
  &quot;object&quot;: &quot;cycle&quot;,
  &quot;number&quot;: 1,
  &quot;description&quot;: &quot;This is a description of the cycle.&quot;,
  &quot;started_at&quot;: 1514764800,
  &quot;ended_at&quot;: 1514764800,
  &quot;is_active&quot;: true,
  &quot;is_public&quot;: true,
  &quot;created_at&quot;: 1514764800,
  &quot;updated_at&quot;: 1514764800,
}</code>
 </pre>
        </span>
        <span id="execution-results-GETapi-organizations--organization--cycles--cycle-" hidden>
          <blockquote>
            Received response
            <span id="execution-response-status-GETapi-organizations--organization--cycles--cycle-"></span>
            :
          </blockquote>
          <pre class="json"><code id="execution-response-content-GETapi-organizations--organization--cycles--cycle-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
        </span>
        <span id="execution-error-GETapi-organizations--organization--cycles--cycle-" hidden>
          <blockquote>Request failed with error:</blockquote>
          <pre><code id="execution-error-message-GETapi-organizations--organization--cycles--cycle-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
        </span>
        <form id="form-GETapi-organizations--organization--cycles--cycle-" data-method="GET" data-path="api/organizations/{organization}/cycles/{cycle}" data-authed="0" data-hasfiles="0" data-isarraybody="0" autocomplete="off" onsubmit="event.preventDefault(); executeTryOut('GETapi-organizations--organization--cycles--cycle-', this);">
          <h3>Request&nbsp;&nbsp;&nbsp;</h3>
          <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/organizations/{organization}/cycles/{cycle}</code></b>
          </p>
          <h4 class="fancy-heading-panel"><b>Headers</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Content-Type</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Content-Type" data-endpoint="GETapi-organizations--organization--cycles--cycle-" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Accept</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Accept" data-endpoint="GETapi-organizations--organization--cycles--cycle-" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
          <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>organization</code></b>
            &nbsp;&nbsp;
            <small>string</small>
            &nbsp; &nbsp;
            <input type="text" style="display: none" name="organization" data-endpoint="GETapi-organizations--organization--cycles--cycle-" value="1" data-component="url" />
            <br />
            <p>
              The id of the organization. Example:
              <code>1</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>cycle</code></b>
            &nbsp;&nbsp;
            <small>integer</small>
            &nbsp; &nbsp;
            <input type="number" style="display: none" step="any" name="cycle" data-endpoint="GETapi-organizations--organization--cycles--cycle-" value="1" data-component="url" />
            <br />
            <p>
              The number of the cycle. Please note that this is not the id of the cycle. Example:
              <code>1</code>
            </p>
          </div>
        </form>

        <h3>Response</h3>
        <h4 class="fancy-heading-panel"><b>Response Fields</b></h4>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>id</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>Unique identifier for the object.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>object</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The object type. Always &quot;cycle&quot;.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>number</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The number of the cycle.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>description</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The description of the cycle.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>started_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The start date of the cycle. Represented as a Unix timestamp.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>ended_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The end date of the cycle. Represented as a Unix timestamp.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>is_active</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>Whether the cycle is active.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>is_public</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>Whether the cycle is public.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>created_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The date the object was created. Represented as a Unix timestamp.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>updated_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The date the object was last updated. Represented as a Unix timestamp.</p>
        </div>
        <h2 id="organizations-PUTapi-organizations--organization--cycles--cycle-">Update a cycle.</h2>

        <p></p>

        <p>Only administrators can update a cycle.</p>

        <span id="example-requests-PUTapi-organizations--organization--cycles--cycle-">
          <blockquote>Example request:</blockquote>

          <div class="bash-example">
            <pre><code class="language-bash">curl --request PUT \
    "https://wassup.test/api/organizations/1/cycles/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"number\": 1,
    \"description\": \"This is a description of the cycle.\",
    \"started_at\": \"2024-01-01\",
    \"ended_at\": \"2024-01-01\",
    \"is_active\": true,
    \"is_public\": true
}"
</code></pre>
          </div>

          <div class="javascript-example">
            <pre><code class="language-javascript">const url = new URL(
    "https://wassup.test/api/organizations/1/cycles/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "number": 1,
    "description": "This is a description of the cycle.",
    "started_at": "2024-01-01",
    "ended_at": "2024-01-01",
    "is_active": true,
    "is_public": true
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
          </div>
        </span>

        <span id="example-responses-PUTapi-organizations--organization--cycles--cycle-">
          <blockquote>
            <p>Example response (200):</p>
          </blockquote>
          <pre>

<code class="language-json" style="max-height: 300px;">{
 &quot;id&quot;: 1,
 &quot;object&quot;: &quot;cycle&quot;,
 &quot;number&quot;: 1,
 &quot;description&quot;: &quot;This is a description of the cycle.&quot;,
 &quot;started_at&quot;: 1514764800,
 &quot;ended_at&quot;: 1514764800,
 &quot;is_active&quot;: true,
 &quot;is_public&quot;: true,
 &quot;created_at&quot;: 1514764800,
 &quot;updated_at&quot;: 1514764800,
}</code>
 </pre>
        </span>
        <span id="execution-results-PUTapi-organizations--organization--cycles--cycle-" hidden>
          <blockquote>
            Received response
            <span id="execution-response-status-PUTapi-organizations--organization--cycles--cycle-"></span>
            :
          </blockquote>
          <pre class="json"><code id="execution-response-content-PUTapi-organizations--organization--cycles--cycle-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
        </span>
        <span id="execution-error-PUTapi-organizations--organization--cycles--cycle-" hidden>
          <blockquote>Request failed with error:</blockquote>
          <pre><code id="execution-error-message-PUTapi-organizations--organization--cycles--cycle-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
        </span>
        <form id="form-PUTapi-organizations--organization--cycles--cycle-" data-method="PUT" data-path="api/organizations/{organization}/cycles/{cycle}" data-authed="0" data-hasfiles="0" data-isarraybody="0" autocomplete="off" onsubmit="event.preventDefault(); executeTryOut('PUTapi-organizations--organization--cycles--cycle-', this);">
          <h3>Request&nbsp;&nbsp;&nbsp;</h3>
          <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/organizations/{organization}/cycles/{cycle}</code></b>
          </p>
          <h4 class="fancy-heading-panel"><b>Headers</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Content-Type</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Content-Type" data-endpoint="PUTapi-organizations--organization--cycles--cycle-" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Accept</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Accept" data-endpoint="PUTapi-organizations--organization--cycles--cycle-" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
          <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>organization</code></b>
            &nbsp;&nbsp;
            <small>string</small>
            &nbsp; &nbsp;
            <input type="text" style="display: none" name="organization" data-endpoint="PUTapi-organizations--organization--cycles--cycle-" value="1" data-component="url" />
            <br />
            <p>
              The id of the organization. Example:
              <code>1</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>cycle</code></b>
            &nbsp;&nbsp;
            <small>integer</small>
            &nbsp; &nbsp;
            <input type="number" style="display: none" step="any" name="cycle" data-endpoint="PUTapi-organizations--organization--cycles--cycle-" value="1" data-component="url" />
            <br />
            <p>
              The number of the cycle. Please note that this is not the id of the cycle. Example:
              <code>1</code>
            </p>
          </div>
          <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>number</code></b>
            &nbsp;&nbsp;
            <small>integer</small>
            &nbsp;
            <i>optional</i>
            &nbsp;
            <input type="number" style="display: none" step="any" name="number" data-endpoint="PUTapi-organizations--organization--cycles--cycle-" value="1" data-component="body" />
            <br />
            <p>
              The number of the cycle. Example:
              <code>1</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>description</code></b>
            &nbsp;&nbsp;
            <small>string</small>
            &nbsp; &nbsp;
            <input type="text" style="display: none" name="description" data-endpoint="PUTapi-organizations--organization--cycles--cycle-" value="This is a description of the cycle." data-component="body" />
            <br />
            <p>
              The description of the cycle. Max 4294967295 characters. Example:
              <code>This is a description of the cycle.</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>started_at</code></b>
            &nbsp;&nbsp;
            <small>string</small>
            &nbsp;
            <i>optional</i>
            &nbsp;
            <input type="text" style="display: none" name="started_at" data-endpoint="PUTapi-organizations--organization--cycles--cycle-" value="2024-01-01" data-component="body" />
            <br />
            <p>
              The start date of the cycle, in ISO 8601 format (YYYY-MM-DD). Example:
              <code>2024-01-01</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>ended_at</code></b>
            &nbsp;&nbsp;
            <small>string</small>
            &nbsp;
            <i>optional</i>
            &nbsp;
            <input type="text" style="display: none" name="ended_at" data-endpoint="PUTapi-organizations--organization--cycles--cycle-" value="2024-01-01" data-component="body" />
            <br />
            <p>
              The end date of the cycle, in ISO 8601 format (YYYY-MM-DD). Example:
              <code>2024-01-01</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>is_active</code></b>
            &nbsp;&nbsp;
            <small>boolean</small>
            &nbsp;
            <i>optional</i>
            &nbsp;
            <label data-endpoint="PUTapi-organizations--organization--cycles--cycle-" style="display: none">
              <input type="radio" name="is_active" value="true" data-endpoint="PUTapi-organizations--organization--cycles--cycle-" data-component="body" />
              <code>true</code>
            </label>
            <label data-endpoint="PUTapi-organizations--organization--cycles--cycle-" style="display: none">
              <input type="radio" name="is_active" value="false" data-endpoint="PUTapi-organizations--organization--cycles--cycle-" data-component="body" />
              <code>false</code>
            </label>
            <br />
            <p>
              Whether the cycle is active. Example:
              <code>true</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>is_public</code></b>
            &nbsp;&nbsp;
            <small>boolean</small>
            &nbsp;
            <i>optional</i>
            &nbsp;
            <label data-endpoint="PUTapi-organizations--organization--cycles--cycle-" style="display: none">
              <input type="radio" name="is_public" value="true" data-endpoint="PUTapi-organizations--organization--cycles--cycle-" data-component="body" />
              <code>true</code>
            </label>
            <label data-endpoint="PUTapi-organizations--organization--cycles--cycle-" style="display: none">
              <input type="radio" name="is_public" value="false" data-endpoint="PUTapi-organizations--organization--cycles--cycle-" data-component="body" />
              <code>false</code>
            </label>
            <br />
            <p>
              Whether the cycle is public. Example:
              <code>true</code>
            </p>
          </div>
        </form>

        <h3>Response</h3>
        <h4 class="fancy-heading-panel"><b>Response Fields</b></h4>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>id</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>Unique identifier for the object.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>object</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The object type. Always &quot;cycle&quot;.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>number</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The number of the cycle.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>description</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The description of the cycle.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>started_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The start date of the cycle. Represented as a Unix timestamp.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>ended_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The end date of the cycle. Represented as a Unix timestamp.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>is_active</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>Whether the cycle is active.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>is_public</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>Whether the cycle is public.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>created_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The date the object was created. Represented as a Unix timestamp.</p>
        </div>
        <div style="padding-left: 28px; clear: unset">
          <b style="line-height: 2"><code>updated_at</code></b>
          &nbsp;&nbsp; &nbsp; &nbsp;
          <br />
          <p>The date the object was last updated. Represented as a Unix timestamp.</p>
        </div>
        <h2 id="organizations-DELETEapi-organizations--organization--cycles--cycle-">Delete a cycle.</h2>

        <p></p>

        <p>Only administrators can delete a cycle.</p>

        <span id="example-requests-DELETEapi-organizations--organization--cycles--cycle-">
          <blockquote>Example request:</blockquote>

          <div class="bash-example">
            <pre><code class="language-bash">curl --request DELETE \
    "https://wassup.test/api/organizations/1/cycles/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
          </div>

          <div class="javascript-example">
            <pre><code class="language-javascript">const url = new URL(
    "https://wassup.test/api/organizations/1/cycles/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre>
          </div>
        </span>

        <span id="example-responses-DELETEapi-organizations--organization--cycles--cycle-">
          <blockquote>
            <p>Example response (200):</p>
          </blockquote>
          <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;
}</code>
 </pre>
        </span>
        <span id="execution-results-DELETEapi-organizations--organization--cycles--cycle-" hidden>
          <blockquote>
            Received response
            <span id="execution-response-status-DELETEapi-organizations--organization--cycles--cycle-"></span>
            :
          </blockquote>
          <pre class="json"><code id="execution-response-content-DELETEapi-organizations--organization--cycles--cycle-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
        </span>
        <span id="execution-error-DELETEapi-organizations--organization--cycles--cycle-" hidden>
          <blockquote>Request failed with error:</blockquote>
          <pre><code id="execution-error-message-DELETEapi-organizations--organization--cycles--cycle-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
        </span>
        <form id="form-DELETEapi-organizations--organization--cycles--cycle-" data-method="DELETE" data-path="api/organizations/{organization}/cycles/{cycle}" data-authed="0" data-hasfiles="0" data-isarraybody="0" autocomplete="off" onsubmit="event.preventDefault(); executeTryOut('DELETEapi-organizations--organization--cycles--cycle-', this);">
          <h3>Request&nbsp;&nbsp;&nbsp;</h3>
          <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/organizations/{organization}/cycles/{cycle}</code></b>
          </p>
          <h4 class="fancy-heading-panel"><b>Headers</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Content-Type</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Content-Type" data-endpoint="DELETEapi-organizations--organization--cycles--cycle-" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Accept</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Accept" data-endpoint="DELETEapi-organizations--organization--cycles--cycle-" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
          <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>organization</code></b>
            &nbsp;&nbsp;
            <small>string</small>
            &nbsp; &nbsp;
            <input type="text" style="display: none" name="organization" data-endpoint="DELETEapi-organizations--organization--cycles--cycle-" value="1" data-component="url" />
            <br />
            <p>
              The id of the organization. Example:
              <code>1</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>cycle</code></b>
            &nbsp;&nbsp;
            <small>integer</small>
            &nbsp; &nbsp;
            <input type="number" style="display: none" step="any" name="cycle" data-endpoint="DELETEapi-organizations--organization--cycles--cycle-" value="1" data-component="url" />
            <br />
            <p>
              The number of the cycle. Please note that this is not the id of the cycle. Example:
              <code>1</code>
            </p>
          </div>
        </form>

        <h1 id="profile">Profile</h1>

        <p>You can modify your profile information here.</p>

        <h2 id="profile-GETapi-me">Get the information about the logged user.</h2>

        <p></p>

        <p>This endpoint gets the information about the logged user.</p>

        <span id="example-requests-GETapi-me">
          <blockquote>Example request:</blockquote>

          <div class="bash-example">
            <pre><code class="language-bash">curl --request GET \
    --get "https://wassup.test/api/me" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
          </div>

          <div class="javascript-example">
            <pre><code class="language-javascript">const url = new URL(
    "https://wassup.test/api/me"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
          </div>
        </span>

        <span id="example-responses-GETapi-me">
          <blockquote>
            <p>Example response (200):</p>
          </blockquote>
          <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 4,
    &quot;name&quot;: &quot;Jessica Jones&quot;,
    &quot;email&quot;: &quot;jessica.jones@gmail.com&quot;
}</code>
 </pre>
        </span>
        <span id="execution-results-GETapi-me" hidden>
          <blockquote>
            Received response
            <span id="execution-response-status-GETapi-me"></span>
            :
          </blockquote>
          <pre class="json"><code id="execution-response-content-GETapi-me"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
        </span>
        <span id="execution-error-GETapi-me" hidden>
          <blockquote>Request failed with error:</blockquote>
          <pre><code id="execution-error-message-GETapi-me">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
        </span>
        <form id="form-GETapi-me" data-method="GET" data-path="api/me" data-authed="0" data-hasfiles="0" data-isarraybody="0" autocomplete="off" onsubmit="event.preventDefault(); executeTryOut('GETapi-me', this);">
          <h3>Request&nbsp;&nbsp;&nbsp;</h3>
          <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/me</code></b>
          </p>
          <h4 class="fancy-heading-panel"><b>Headers</b></h4>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Content-Type</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Content-Type" data-endpoint="GETapi-me" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
          <div style="padding-left: 28px; clear: unset">
            <b style="line-height: 2"><code>Accept</code></b>
            &nbsp;&nbsp; &nbsp; &nbsp;
            <input type="text" style="display: none" name="Accept" data-endpoint="GETapi-me" value="application/json" data-component="header" />
            <br />
            <p>
              Example:
              <code>application/json</code>
            </p>
          </div>
        </form>
      </div>
      <div class="dark-box">
        <div class="lang-selector">
          <button type="button" class="lang-button" data-language-name="bash">bash</button>
          <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
        </div>
      </div>
    </div>
  </body>
</html>
