import { FormElement } from "./FormElement";
import { MapSVG } from "../../Core/globals.js";
import { Server } from "../../Infrastructure/Server/Server";
const $ = jQuery;
export class PostFormElement extends FormElement {
    constructor(options, formBuilder, external) {
        super(options, formBuilder, external);
        if (this.formBuilder.admin)
            this.post_types = this.formBuilder.admin.getPostTypes();
        this.post_type = options.post_type || this.post_types[0];
        this.add_fields = MapSVG.parseBoolean(options.add_fields);
        this.db_type = 'int(11)';
        this.name = 'post_id';
        this.post_id = options.post_id;
        this.post = options.post;
    }
    setDomElements() {
        super.setDomElements();
        this.inputs.postSelect = $(this.domElements.main).find(".mapsvg-find-post")[0];
        this.inputs.postId = $(this.domElements.main).find('input[name="post_id"]')[0];
    }
    getSchema() {
        let schema = super.getSchema();
        schema.post_type = this.post_type;
        schema.add_fields = this.add_fields;
        return schema;
    }
    destroy() {
        if ($().mselect2) {
            let sel = $(this.domElements.main).find('.mapsvg-select2');
            if (sel.length) {
                sel.mselect2('destroy');
            }
        }
    }
    getDataForTemplate() {
        let data = super.getDataForTemplate();
        if (this.formBuilder.admin)
            data.post_types = this.formBuilder.admin.getPostTypes();
        data.post_type = this.post_type;
        data.post = this.post;
        data.add_fields = this.add_fields || 0;
        return data;
    }
    setEventHandlers() {
        super.setEventHandlers();
        let _this = this;
        let server = new Server();
        $(this.inputs.postSelect).mselect2({
            placeholder: 'Search post by title',
            allowClear: true,
            ajax: {
                url: server.getUrl('posts'),
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        filters: { post_type: _this.post_type },
                        search: params.term,
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.posts ? data.posts : [],
                        pagination: {
                            more: false
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            },
            minimumInputLength: 1,
            templateResult: formatRepo,
            templateSelection: formatRepoSelection
        }).on('select2:select', function (e) {
            _this.post = e.params.data;
            $(_this.domElements.main).find(".mapsvg-post-id").text(_this.post.id);
            $(_this.domElements.main).find(".mapsvg-post-url").text(_this.post.url).attr('href', _this.post.url);
            $(_this.inputs.postId).val(_this.post.id);
            _this.value = _this.post.id;
            _this.events.trigger('change');
        }).on('change', function (e) {
            if (e.target.value === '') {
                $(_this.domElements.main).find(".mapsvg-post-id").text('');
                $(_this.domElements.main).find(".mapsvg-post-url").text('');
                $(_this.inputs.postId).val('');
                _this.value = '';
                _this.events.trigger('change');
            }
        });
        function formatRepo(repo) {
            if (repo.loading) {
                return repo.text;
            }
            else {
                return "<div class='select2-result-repository clearfix'>" +
                    repo.post_title + "</div>";
            }
        }
        function formatRepoSelection(repo) {
            return repo.post_title || repo.text;
        }
    }
}
//# sourceMappingURL=PostFormElement.js.map