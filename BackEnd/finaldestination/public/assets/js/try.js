addToolbar: function (t) {
            var e = L.DomUtil.create("div", "leaflet-draw-section"),
                i = 0,
                o = "leaflet-draw-edit",
                a = this.options.featureGroup;
            return this._toolbarContainer = L.DomUtil.create("div", "leaflet-draw-toolbar leaflet-bar"), this._map = t, this.options.edit && this._initModeHandler(new L.EditToolbar.Edit(t, {
                featureGroup: a,
                selectedPathOptions: this.options.edit.selectedPathOptions
            }), this._toolbarContainer, i++, o, L.drawLocal.edit.toolbar.buttons.edit), this.options.remove && this._initModeHandler(new L.EditToolbar.Delete(t, {
                featureGroup: a
            }), this._toolbarContainer, i++, o, L.drawLocal.edit.toolbar.buttons.remove), this._lastButtonIndex = --i, this._actionsContainer = this._createActions([{
                title: L.drawLocal.edit.toolbar.actions.save.title,
                text: L.drawLocal.edit.toolbar.actions.save.text,
                callback: this._save,
                context: this
            }, {
                title: L.drawLocal.edit.toolbar.actions.cancel.title,
                text: L.drawLocal.edit.toolbar.actions.cancel.text,
                callback: this.disable,
                context: this
            }]), e.appendChild(this._toolbarContainer), e.appendChild(this._actionsContainer), this._checkDisabled(), a.on("layeradd layerremove", this._checkDisabled, this), e
        },


addToolbar: function (t) {
            var e = L.DomUtil.create("div", "leaflet-draw-section"),
                i = 0,
                o = "leaflet-draw-draw";
                a = this.options.featureGroup;
            return this._toolbarContainer = L.DomUtil.create("div", "leaflet-draw-toolbar leaflet-bar"), this.options.polyline && this._initModeHandler(new L.Draw.Polyline(t,{
                featureGroup: a,
                selectedPathOptions: this.options.polyline
            }), this._toolbarContainer, i++, o, L.drawLocal.draw.toolbar.buttons.polyline),  this.options.polygon && this._initModeHandler(new L.Draw.Polygon(t, {
                featureGroup: a,
                selectedPathOptions: this.options.polygon
            }), this._toolbarContainer, i++, o, L.drawLocal.draw.toolbar.buttons.polygon), this.options.rectangle && this._initModeHandler(new L.Draw.Rectangle(t, {
                featureGroup: a,
                selectedPathOptions: this.options.rectangle
            }), this._toolbarContainer, i++, o, L.drawLocal.draw.toolbar.buttons.rectangle), this.options.circle && this._initModeHandler(new L.Draw.Circle(t, {
                featureGroup: a,
                selectedPathOptions: this.options.circle
            }), this._toolbarContainer, i++, o, L.drawLocal.draw.toolbar.buttons.circle), this.options.marker && this._initModeHandler(new L.Draw.Marker(t, {
                featureGroup: a,
                selectedPathOptions: this.options.marker
            }), this._toolbarContainer, i++, o, L.drawLocal.draw.toolbar.buttons.marker), this._lastButtonIndex = --i, this._actionsContainer = this._createActions([{
                title: L.drawLocal.draw.toolbar.actions.title,
                text: L.drawLocal.draw.toolbar.actions.text,
                callback: this.disable,
                context: this
            },
                {
                title: L.drawLocal.draw.toolbar.actions.title,
                text: L.drawLocal.draw.toolbar.actions.text,
                callback: this.disable,
                context: this
            }]), e.appendChild(this._toolbarContainer), e.appendChild(this._actionsContainer), this._checkDisabled(), a.on("layeradd layerremove", this._checkDisabled, this), e
        },