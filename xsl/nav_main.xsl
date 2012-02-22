<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet [<!ENTITY nbsp "&#160;">]>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html" encoding="utf-8" indent="yes"/>
	<xsl:param name="label"/>
	<xsl:param name="locale"/>
	<xsl:template match="/root">
		<ul>
			<xsl:apply-templates select="group[@label = $label]/item">
				<xsl:sort select="@indx" order="ascending"/>
			</xsl:apply-templates>
			<li>
				<xsl:if test="$locale = 'ru'">
					<a href="mailto:info@coec.ca"> Отправьте<br/>
					запрос </a>
				</xsl:if>
				<xsl:if test="$locale = 'en'">
					<a href="mailto:info@coec.ca">Send<br/>
					request</a>
				</xsl:if>
			</li>
		</ul>
	</xsl:template>
	<xsl:template match="item">
		<li><a href="{@href}">
			<xsl:attribute name="class">
			<xsl:if test="@href = //@current_url">
				active
			</xsl:if>
			</xsl:attribute>
			<xsl:value-of select="@name" disable-output-escaping="yes"/></a></li>
	</xsl:template>
</xsl:stylesheet>