<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet [<!ENTITY nbsp "&#160;">]>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html" encoding="utf-8" indent="yes"/>
	<xsl:param name="label"/>
	<xsl:template match="/root">
		<ul>
		<xsl:apply-templates select="group[@label = $label]/item">
			<xsl:sort select="@indx" order="ascending"/>
		</xsl:apply-templates>
		</ul>
	</xsl:template>
	<xsl:template match="item">
		<li><a href="{@href}"><xsl:value-of select="@name"/></a></li>
	</xsl:template>
</xsl:stylesheet>