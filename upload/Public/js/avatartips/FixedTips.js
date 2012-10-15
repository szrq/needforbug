var FixedTips = function(tip, options){
	this.tip = $$(tip);//��ʾ��
	
	this._trigger = null;//��������
	this._timer = null;//��ʱ��
	this._onshow = false;//��¼��ǰ��ʾ״̬
	
	this._setOptions(options);
	//����Tip��ʽ
	$$D.setStyle(this.tip, {
		position: "absolute", visibility: "hidden", display: "block",
		zIndex: 99, margin: 0,//���ⶨλ����
		left: "-9999px", top: "-9999px"//����ռλ���ֹ�����
	});
	
	//offset��������
	var iLeft = 0, iTop = 0, p = this.tip;
	while (p.offsetParent) {
		p = p.offsetParent; iLeft += p.offsetLeft; iTop += p.offsetTop;
	};
	this._offsetleft = iLeft;
	this._offsettop = iTop;
	//����Tip����ʱ������ʾ״̬
	$$E.addEvent(this.tip, "mouseover", $$F.bindAsEventListener(function(e){
		//������ⲿԪ�ؽ��룬˵����ǰ��������ʱ�׶Σ���ô�����ʱ��ȡ������
		this._check(e.relatedTarget) && clearTimeout(this._timer);
	}, this));
	//ie6����select
	if ( $$B.ie6 ) {
		var iframe = document.createElement("<iframe style='position:absolute;filter:alpha(opacity=0);display:none;'>");
		document.body.insertBefore(iframe, document.body.childNodes[0]);
		this._iframe = iframe;
	};
	//���ڵ����ʽ����
	this._fCH = $$F.bindAsEventListener(function(e) {
		if (this._check(e.target) && this._checkHide()) {
			this._readyHide(this._isClick(this._trigger.hideDelayType));
		};
	}, this);
	//���ڴ�����ʽ����
	this._fTH = $$F.bindAsEventListener(function(e) {
		if (this._check(e.relatedTarget) && this._checkHide()) {
			this._readyHide(this._isTouch(this._trigger.hideDelayType));
		};
	}, this);
};
FixedTips.prototype = {
  //����Ĭ������
  _setOptions: function(options) {
	this.options = {//Ĭ��ֵ
		showType:		"both",//��ʾ��ʽ
		hideType:		"both",//���ط�ʽ
		showDelayType:	"touch",//��ʾ�ӳٷ�ʽ
		hideDelayType:	"touch",//�����ӳٷ�ʽ
		//"click":ֻ�õ����ʽ,"touch":ֻ�ô�����ʽ,"both":������ʹ��,"none":����ʹ��
		showDelay:		300,//��ʾ��ʱʱ��
		hideDelay:		300,//������ʱʱ��
		relative:		{},//��λ����
		onShow:			function(){},//��ʾʱִ��
		onHide:			function(){}//����ʱִ��
	};
	$$.extend(this.options, options || {});
  },
  //��鴥��Ԫ��
  _check: function(elem) {
	//�����Ƿ��ⲿԪ�أ�������Ԫ�غ�Tip���������ڲ�Ԫ�������Ԫ�ض���
	return !this._trigger ||
		!(
			this.tip === elem || this._trigger.Elem === elem
				|| $$D.contains(this.tip, elem) || $$D.contains(this._trigger.Elem, elem)
		);
  },
  //׼����ʾ
  _readyShow: function(delay) {
	clearTimeout(this._timer);
	var trigger = this._trigger;
	//������ʽ����
	this._isTouch(trigger.hideType) && $$E.addEvent(this._trigger.Elem, "mouseout", this._fTH);
	//�����ʽ����
	this._isClick(trigger.hideType) && $$E.addEvent(document, "click", this._fCH);
	//��ʾ
	if (delay) {
		this._timer = setTimeout($$F.bind(this.show, this), trigger.showDelay);
	} else { this.show(); };
  },
  //��ʾ
  show: function() {
	clearTimeout(this._timer);
	this._trigger.onShow();//����ǰ�淽���޸�����
	//����Ԥ�趨λ���Զ��嶨λ����left��top
	var trigger = this._trigger
		,pos = RelativePosition(trigger.Elem, this.tip, trigger.relative)
		,iLeft = pos.Left, iTop = pos.Top;
	//����λ�ò���ʾ
	$$D.setStyle(this.tip, {
		left: iLeft - this._offsetleft + "px",
		top: iTop - this._offsettop + "px",
		visibility: "visible"
	});
	//ie6����select
	if ( $$B.ie6 ) {
		$$D.setStyle(this._iframe, {
			width: this.tip.offsetWidth + "px",
			height: this.tip.offsetHeight + "px",
			left: iLeft + "px", top: iTop + "px",
			display: ""
		});
	};
	//������ʽ����
	this._isTouch(trigger.hideType) && $$E.addEvent(this.tip, "mouseout", this._fTH);
  },
  //׼������
  _readyHide: function(delay) {
	clearTimeout(this._timer);
	if (delay) {
		this._timer = setTimeout($$F.bind(this.hide, this), this._trigger.hideDelay);
	} else { this.hide(); };
  },
  //����
  hide: function() {
	clearTimeout(this._timer);
	//��������
	$$D.setStyle(this.tip, {
		visibility: "hidden", left: "-9999px", top: "-9999px"
	});
	//ie6����select
	if ( $$B.ie6 ) { this._iframe.style.display = "none"; };
	//����������
	if (!!this._trigger) {
		this._trigger.onHide();
		$$E.removeEvent(this._trigger.Elem, "mouseout", this._fTH);
	}
	this._trigger = null;
	//�Ƴ��¼�
	$$E.removeEvent(this.tip, "mouseout", this._fTH);
	$$E.removeEvent(document, "click", this._fCH);
  },
  //��Ӵ�������
  add: function(elem, options) {
	//����һ����������
	var elem = $$(elem), trigger = $$.extend( $$.extend( { Elem: elem }, this.options ), options || {} );
	//�����ʽ��ʾ
	$$E.addEvent(elem, "click", $$F.bindAsEventListener(function(e){
		if ( this._isClick(trigger.showType) ) {
			if ( this._checkShow(trigger) ) {
				this._readyShow(this._isClick(trigger.showDelayType));
			} else {
				clearTimeout(this._timer);
			};
		};
	}, this));
	//������ʽ��ʾ
	$$E.addEvent(elem, "mouseover", $$F.bindAsEventListener(function(e){
		if ( this._isTouch(trigger.showType) ) {
			if (this._checkShow(trigger)) {
				this._readyShow(this._isTouch(trigger.showDelayType));
			} else if (this._check(e.relatedTarget)) {
				clearTimeout(this._timer);
			};
		};
	}, this));
	//���ش�������
	return trigger;
  },
  //��ʾ���
  _checkShow: function(trigger) {
	if ( trigger !== this._trigger ) {
		//����ͬһ�������������ִ��hide��ֹ��ͻ
		this.hide(); this._trigger = trigger; return true;
	} else { return false; };
  },
  //���ؼ��
  _checkHide: function() {
	if ( this.tip.style.visibility === "hidden" ) {
		//������������״̬������Ҫ��ִ��hide
		clearTimeout(this._timer);
		$$E.removeEvent(this._trigger.Elem, "mouseout", this._fTH);
		this._trigger = null;
		$$E.removeEvent(document, "click", this._fCH);
		return false;
	} else { return true; };
  },
  //�Ƿ�����ʽ
  _isClick: function(type) {
	type = type.toLowerCase();
	return type === "both" || type === "click";	
  },
  //�Ƿ񴥷���ʽ
  _isTouch: function(type) {
	type = type.toLowerCase();
	return type === "both" || type === "touch";	
  }
};